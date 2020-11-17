FROM debian:buster-slim
MAINTAINER Rostislav Mykhajliw <necromant2005@gmail.com>

LABEL name="truesocialmetrics/headless-chrome " \
            description="Headlesschrome based on Justin Ribeiro <justin@justinribeiro.com> Google Chrome Headless in a container"

# Install deps + add Chrome Stable + purge all the things
RUN apt-get update && apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg \
    --no-install-recommends \
    && curl -sSL https://dl.google.com/linux/linux_signing_key.pub | apt-key add - \
    && echo "deb https://dl.google.com/linux/chrome/deb/ stable main" > /etc/apt/sources.list.d/google-chrome.list \
    && apt-get update && apt-get install -y \
    google-chrome-stable \
    fontconfig \
    fonts-ipafont-gothic \
    fonts-wqy-zenhei \
    fonts-thai-tlwg \
    fonts-kacst \
    fonts-symbola \
    fonts-noto \
    fonts-freefont-ttf \
    --no-install-recommends \
    && apt-get purge --auto-remove -y curl gnupg \
    && rm -rf /var/lib/apt/lists/*

# Install yarn + node deps
RUN apt-get update \
    && apt-get install -y build-essential \
    && apt-get install -y curl \
    && curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
    && apt-get update && apt-get install yarn \
    && rm -rf /var/lib/apt/lists/*

RUN npm i --save puppeteer

COPY html2pdf.js /html2pdf.js

CMD ["/bin/bash"]
