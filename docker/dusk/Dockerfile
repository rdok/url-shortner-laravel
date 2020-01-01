FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
        libnss3 \
        libx11-6 \
        wget \
        unzip \
        libu2f-udev \
  && docker-php-ext-install zip

WORKDIR /tmp

# Chrome Browser
ADD https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb  .
RUN apt-get install -yf ./google-chrome-stable_current_amd64.deb

RUN rm -rf /tmp/* \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/*