FROM ubuntu:18.04

MAINTAINER Rostislav Mykhajliw <necromant2005@gmail.com>

# base
RUN apt-get update
RUN apt-get install -y wget bzip2


# phantomjs
RUN apt-get install -y fontconfig
RUN wget https://github.com/necromant2005/tt-package/raw/master/phantomjs-1.9.8-linux-x86_64.tar.bz2 -O /tmp/phantomjs.tar.bz2 \
    && cd /tmp && tar -xvf /tmp/phantomjs.tar.bz2 \
    && mv /tmp/phantomjs-1.9.8-linux-x86_64 /tmp/phantomjs \
    && mv /tmp/phantomjs /opt \
    && ln -s /opt/phantomjs/bin/phantomjs /usr/local/bin/phantomjs \
    && rm -rf /tmp/phantomjs.tar.bz2

# casperjs
RUN apt-get install -y python
RUN wget https://github.com/casperjs/casperjs/archive/1.1.4.tar.gz -O /tmp/casperjs.tar.gz \
    && cd /tmp && tar -xvf casperjs.tar.gz \
    && mv /tmp/casperjs-1.1.4 /tmp/casperjs \
    && mv /tmp/casperjs /opt \
    && ln -s /opt/casperjs/bin/casperjs /usr/local/bin/casperjs \
    && rm -rf /tmp/casperjs.tar.gz

CMD ["/bin/bash"]
