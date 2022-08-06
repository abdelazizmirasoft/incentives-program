FROM php:7.1-fpm

ARG DOCKER_USER="devops"
ARG GIT_USER_NAME="abdelazizmirasoft"
ARG GIT_USER_EMAIL="abdelaziz.mirasoft@gmail.com"


# Install packages
RUN apt-get update \
    && apt-get install -y \
        libicu-dev \
        zlib1g-dev \
        git \
        sudo \
        wget \
        nano \
    && docker-php-ext-install \
        zip \
        intl \
        json \
        mbstring \
        mysqli \
        pdo_mysql \
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer


# Install xdebug extention
RUN pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug


# Install PhpMetrics
RUN wget -O /phpmetrics.phar http://github.com/phpmetrics/PhpMetrics/raw/master/build/phpmetrics.phar
RUN chmod +x /phpmetrics.phar
RUN mv /phpmetrics.phar /usr/local/bin/phpmetrics


# Add user DOCKER_USER defined in .env & give sudo privilege
RUN adduser --disabled-password --gecos '' ${DOCKER_USER}
RUN adduser ${DOCKER_USER} sudo
RUN echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers


# Override default bash config
ADD .bashrc /home/${DOCKER_USER}/.bashrc
RUN chown ${DOCKER_USER}:${DOCKER_USER} /home/${DOCKER_USER}/.bashrc


# Install Php cs-fixer
RUN wget https://github.com/FriendsOfPHP/PHP-CS-Fixer/releases/download/v3.0.1/php-cs-fixer.phar -O php-cs-fixer
RUN chmod a+x php-cs-fixer
RUN mv php-cs-fixer /usr/local/bin/php-cs-fixer


# Configure git
RUN su ${DOCKER_USER} -c "git config --global user.name ${GIT_USER_NAME}"
RUN su ${DOCKER_USER} -c "git config --global user.email ${GIT_USER_EMAIL}"
RUN su ${DOCKER_USER} -c "git config --global core.editor nano"



# Add Provisionning Scripts
ADD entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
