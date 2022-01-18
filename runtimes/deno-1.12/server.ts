import { Application } from "https://deno.land/x/oak@v8.0.0/mod.ts";
import * as path from "https://deno.land/std@0.110.0/path/mod.ts";

const app = new Application();

class Request {
  constructor(
    env: Record<string, string>,
    headers: Record<string, string>,
    payload: string,
  ) {
    this.env = env;
    this.headers = headers;
    this.payload = payload;
  };

  public env: Record<string, string>;
  public headers: Record<string, string>;
  public payload: string;
}

class Response {
  private ctx: &any;

  constructor(ctx: &any) {
    this.ctx = ctx;
  }

  send(text: string, status = 200) {
    this.ctx.response.status = status;
    this.ctx.response.body = text;
  }

  json(json: Record<string, unknown>, status = 200) {
    this.ctx.response.status = status;
    this.ctx.response.body = json;
  }
}

app.use(async (ctx) => {
  const { value } = ctx.request.body({ type: 'json' });
  const body = await value;

  if (ctx.request.headers.get("x-internal-challenge") !== Deno.env.get("INTERNAL_RUNTIME_KEY")) {
    ctx.response.status = 401;
    ctx.response.body = {
      code: 401,
      message: "Unauthorized"
    };
    return;
  }

  const request = new Request(body.env, body.headers, body.payload);
  const response = new Response(ctx);

  try {
    const userFunction = (await import(path.join(body.path, body.file))).default;

    if (!(userFunction || userFunction.constructor || userFunction.call || userFunction.apply)) {
      throw new Error("User function is not valid.")
    }

    await userFunction(request, response);
  } catch (error) {
    ctx.response.status = 500;
    ctx.response.body = {
      code: 500,
      message: error.message.includes("Cannot resolve module") ? 'Code file not found.' : error.stack || error.message
    };
  }
});

await app.listen({ port: 3000 });