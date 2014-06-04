var casper = require("casper").create({});


input = casper.cli.get('input');
output = casper.cli.get('output');


casper.start();

casper.viewport(1024, 768);

casper.thenOpen(input, function() {
});

casper.waitFor(function() {
    return this.evaluate(function() {
      return document;
    });
  },
  function then() {}
);

casper.then(function() {
  this.capture(output);
});

casper.run(function() {
    this.exit();
});