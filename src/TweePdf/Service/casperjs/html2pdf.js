var casper = require("casper").create({});

input = casper.cli.get('input');
output = casper.cli.get('output');

casper
    .start()
    .viewport(768, 1024)
    .page.paperSize = {
      width: '8.5in',
      height: '11in',
      format: 'A4',
      orientation: 'portrait',
      border: '0.4in',
      margin: '0.4in'
    };

casper.on('remote.message', function(msg) {
    this.echo('remote message caught: ' + msg);
});
casper.on( 'page.error', function (msg, trace) {
    this.echo( 'Error: ' + msg, 'ERROR' );
});


casper
    .thenOpen(input)
    .thenEvaluate(function(){
    })
    .then(function() {
        this.capture(output);
    });

casper.run(function() {
    this.exit();
});

