FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
        libnss3 \
        libx11-6 \
        wget \
        unzip \
        libu2f-udev

WORKDIR /tmp

# Chrome Browser
ADD https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb  .
RUN apt-get install -yf ./google-chrome-stable_current_amd64.deb

# Chrome Driver
RUN version="$(curl https://chromedriver.storage.googleapis.com/LATEST_RELEASE_79)" \
    && wget -q "https://chromedriver.storage.googleapis.com/${version}/chromedriver_linux64.zip" \
    && unzip chromedriver_linux64.zip \
    && mv chromedriver /home/chromedrive

RUN rm -rf /tmp/* \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/*