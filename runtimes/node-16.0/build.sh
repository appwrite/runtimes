# Install Server's dependencies
cd /usr/local/src/
npm install

# Install User Function Dependencies
cd /usr/code
npm install

# Merge the node_modules from the server into the user's node_modules to be restored later.
rsync -a /usr/local/src/node_modules /usr/code/node_modules