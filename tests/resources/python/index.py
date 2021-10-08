import sys

def main(req, res):
    return res.json({
        'normal': 'Hello World!',
        'env1': req.env['ENV1'],
        'payload': req.payload
    })