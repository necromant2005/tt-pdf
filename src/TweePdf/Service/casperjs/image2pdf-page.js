var casper = require("casper").create();

input = casper.cli.get('input');
output = casper.cli.get('output');

casper.start();

casper.page.paperSize = {
  width: '8.5in',
  height: '11in',
  orientation: 'portrait',
  border: '0.0in'
};

casper.thenOpen(input, function() {
  this.capture(output);
});

casper.run();