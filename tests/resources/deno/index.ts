export default function(req: any, res: any) {
    res.json({
        normal: 'Hello World!',
        env1: req.env['ENV1'],
        payload: req.payload
    });
}