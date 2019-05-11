# Orange Layouts

> Module by Acro Media Inc.

## Introduction

Provides various layout configurations to be used by Drupal's Layout API and Entity Reference with Layout.

## Requirements

- Core: Layout Discovery
- Contrib: Paragraphs
- Contrib: Entity Reference with Layout

## Installation

Enable the module and the layouts provided by the module's layouts.yml will be available to use within Drupal.

## Configuration

This module hides the ERL Form 'Layout Options' form element through CSS via the 'acro_orange_layouts/admin' library. It does this because the provided layout options from the ERL module is not complete and we prefer to control layout options through the 'Section' paragraph instead. You can easily remove or place the 'acro_orange_layouts/admin' library if this is not desired. Read more about this related issue: https://www.drupal.org/project/entity_reference_layout/issues/3038533

The layouts make use of Bootstrap markup, so make sure to have the appropriate Bootstrap assets within your site theme or override the layout templates as necessary.
