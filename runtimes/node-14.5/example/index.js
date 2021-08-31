const fetch = require("node-fetch");
module.exports = async (req, res) => {
    const data = await fetch("https://jsonplaceholder.typicode.com/todos/1").then(r => r.json())
    res.json(data);
}