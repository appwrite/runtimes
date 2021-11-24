# Install User Function Dependencies
cd /usr/code
npm install

mkdir -p node_modules

# Merge the node_modules from the server into the user's node_modules to be restored later.
cp -R /usr/local/src/node_modules/* /usr/code/node_modules