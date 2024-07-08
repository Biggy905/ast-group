FROM php:8.2-cli-alpine

ENV MUSL_LOCPATH="/usr/share/i18n/locales/musl"

RUN echo "UTC" > /etc/timezone

RUN apk add --update linux-headers

RUN apk add --no-cache \
        autoconf g++ make \
        cmake  \
        gcc \
        git \
        gettext \
        gettext-dev \
        git-lfs \
        openssh \
        libmcrypt-dev \
        libltdl \
        libintl \
        libzip-dev \
        libpng-dev \
        libjpeg-turbo \
        libjpeg-turbo-dev \
        libpng \
        freetype \
        freetype-dev \
        icu-dev \
        icu-libs \
        icu-data-full \
        icu \
        imagemagick  \
        imagemagick-dev \
        zlib-dev \
        tzdata

RUN git lfs install

RUN apk add -U shadow

RUN pecl install -o -f redis imagick

RUN docker-php-ext-configure intl

RUN docker-php-ext-install -j$(nproc) gd mysqli gettext pdo pdo_mysql zip bcmath intl

RUN docker-php-ext-enable gd redis imagick intl

RUN docker-php-ext-configure gd \
            --with-freetype=/usr/include/ \
            --with-jpeg=/usr/include/

RUN docker-php-ext-configure gettext
RUN docker-php-ext-install gettext
RUN docker-php-ext-enable gettext

#RUN pecl install xdebug-3.3.1 \
#    && docker-php-ext-enable xdebug

#WORKDIR /usr/share/i18n/locales/
#RUN pwd
RUN git clone https://gitlab.com/rilian-la-te/musl-locales
RUN cd musl-locales && cmake -DLOCALE_PROFILE=OFF -DCMAKE_INSTALL_PREFIX:PATH=/usr . && make && make install
#RUN cd ../ && rm -r musl-locales
#RUN	apk del .locale_build

RUN cp /usr/share/zoneinfo/Europe/Moscow /etc/localtime

ENV LC_ALL ru_RU.UTF-8

COPY ./docker/php/8.2/config /usr/local/etc/php/conf.d

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN usermod -u 1000 www-data

# Set default directory
WORKDIR /app/src
