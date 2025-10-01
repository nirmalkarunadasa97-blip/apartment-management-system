# Apartment Images Fix Plan

## Information Gathered

-   ApartmentController handles multiple images upload and stores them in the apartment_images table.
-   Apartment model has a relationship with ApartmentImage model via images().
-   ApartmentImage model stores image_path, image_name, and order.
-   Views (create, edit, show, index) currently use a single "photo" attribute from the apartments table, but the controller stores multiple images in apartment_images table.
-   Mismatch between single photo display and multiple images storage causes images not to work as intended.

## Plan

-   Update Apartment model to include "photo" in fillable if needed for backward compatibility, but prioritize multiple images.
-   Update create.blade.php to allow multiple image uploads (name="images[]" multiple).
-   Update edit.blade.php to display existing multiple images and allow adding more.
-   Update show.blade.php to display all images from the images relationship.
-   Update index.blade.php to display the first image or a representative image from the images relationship.
-   Update ApartmentController to handle both single photo (if kept) and multiple images, but focus on multiple.
-   Add image deletion functionality in edit view if needed.

## Dependent Files to Edit

-   app/Models/Apartment.php
-   app/Http/Controllers/ApartmentController.php
-   resources/views/apartments/create.blade.php
-   resources/views/apartments/edit.blade.php
-   resources/views/apartments/show.blade.php
-   resources/views/apartments/index.blade.php

## Followup Steps

-   Test image upload in create form.
-   Test image display in index, show views.
-   Test adding more images in edit form.
-   Ensure storage link is set up for public disk.
-   Check for any errors in console or logs.
