const puppeteer = require('puppeteer');         // include library
const fs = require('fs');
const args = process.argv.slice(2);
const inputUrl = args[0];
const outputPdf = args[1];

// console.log(inputUrl);
// console.log(outputPdf);

(async () => {                                  // declare function
  const browser = await puppeteer.launch({
    headless: true,
    args: [
      '--no-sandbox',
      '--single-process'
    ],
    timeout: 10000
  });     // run browser
  const page = await browser.newPage();         // create new tab
  page.setViewport({ width: 1240, height: 1754, isMobile: false });
  await page.emulateMediaType(null);
  // await page.goto(inputUrl);  // go to page


  const html = fs.readFileSync(inputUrl, 'utf8')
  await page.setContent(html, {
    // waitUntil: 'domcontentloaded',
    waitUntil: 'networkidle0'
  });

  await page.pdf({
    format: 'A4',
    path: outputPdf,
    printBackground: true
  });

  await browser.close();                        // close browser
})();
