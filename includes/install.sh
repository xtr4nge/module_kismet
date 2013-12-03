#!/bin/bash

mkdir tmp-install
cd tmp-install

# KISMET 
echo "installing Kismet..."
apt-get -y install libncurses5-dev
apt-get -y install libpcap-dev

wget http://www.kismetwireless.net/code/kismet-2013-03-R1b.tar.xz
tar xvf kismet-2013-03-R1b.tar.xz
cd kismet-2013-03-R1b
./configure
make dep
make
make install
cd ../

cp /usr/local/bin/kismet /usr/bin/
cp /usr/local/bin/kismet_server /usr/bin/


# GISKismet
echo ""
echo "installing GISKismet..."
apt-get -y install libxml-libxml-perl 
apt-get -y install libdbi-perl 
apt-get -y install libdbd-sqlite3-perl

svn co https://my-svn.assembla.com/svn/giskismet/trunk giskismet
cd giskismet
perl Makefile.PL
make
make install
cd ../

cp /usr/local/bin/giskismet /usr/bin/


# INSTALL GPSD
echo ""
echo "installing gpsd..."
apt-get -y install gpsd
apt-get -y install gpsd-clients
echo ""

echo "..DONE.."
exit
