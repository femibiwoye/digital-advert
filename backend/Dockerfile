FROM yiisoftware/yii2-php:7.2-apache

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf

RUN apt-get -qq update \
    && apt-get -qqy install \
        ruby-full \
        \
        && gem install twurl


#RUN cat /etc/lsb-release
#RUN yum --update add bash ruby

#RUN gem install --no-ri --no-rdoc twurl