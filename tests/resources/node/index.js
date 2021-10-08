module.exports = (req, res) => {
    res.json({
        'normal': 'Hello World!',
        'env1': req.env['ENV1'],
        'payload': req.payload
    });
}