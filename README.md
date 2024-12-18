# Mybooking Campers

Tags: custom-post-type
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple plugin for generating Mybooking camper/motorhome custom post type.

IMPORTANT: this plugin **depends on Mybooking Reservation Engine**

## Description

Generates an archive page accessible at /camper and single posts pages that you can reach at /camper/post-name.

The custom post type has the following features:
* Image gallery
* Interior details gallery
* Youtube video
* Custom fields
* Custom taxonomy
* Featured image
* Gutenberg editor for description
* Widget area on sidebar
* Automatic contact form
* Booking calendar via Mybooking's `product_id`

Additionally creates a shortcode that you can place anywhere in order to show the last six posts.

Works best with Mybooking Theme but is also compatible with Neve and Storefront by now. We are working on more theme compatibilities.

Currently is translated to spanish. More translations soon.

## Installation

Install it uploading the zip package to your WordPress instance and proceed as usual. The you get a new menu item where you can add your campers.

## Usage

Create posts related to campers and motorhomes with the new menu entry like you do with normal posts. Feel the form, upload some images and featured image and a description on Gutenberg editor area.

Show your posts anywhere on your site by placing the following shortcode:
`[mybooking_campers_loop]`
