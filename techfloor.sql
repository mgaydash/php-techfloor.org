-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 50.63.224.120
-- Generation Time: Oct 17, 2013 at 04:41 PM
-- Server version: 5.0.96
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `techfloor`
--

-- --------------------------------------------------------

--
-- Table structure for table `lolPlayer`
--

CREATE TABLE `lolPlayer` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `sname` varchar(256) NOT NULL,
  `tId` int(11) default NULL,
  `wins` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `lolTeam`
--

CREATE TABLE `lolTeam` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `pw` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `fName` varchar(256) NOT NULL,
  `lName` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `summoner` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

