var casper = require("casper").create({});


input = casper.cli.get('input');
output = casper.cli.get('output');


casper.start();

casper.viewport(1024, 768);

casper.thenOpen(input, function() {
});

casper.then(function() {
  this.wait(2000);
});

casper.then(function() {
  this.capture(output);
});

casper.run(function() {
    this.exit();
});