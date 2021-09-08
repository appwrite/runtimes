import sys

def main(req, res):
    return res.json({'Hello': 'World!', 'Python Version': sys.version})