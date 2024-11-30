const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  
  // Bắt các yêu cầu mạng
  page.on('request', request => {
    console.log('Request:', request.url());
  });

  await page.goto('https://fujifilm-xspace.vn');
  
  // Đợi một chút để bắt các yêu cầu mạng
  await page.waitForTimeout(5000);

  await browser.close();
})();