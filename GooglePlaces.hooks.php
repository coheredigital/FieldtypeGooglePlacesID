<?php

namespace ProcessWire;

/**
 * ProcessWire Google Place ID Fieldtype Hooks
 *
 * Adds some simple convenience methods to easily retrieve the Google Places details and
 * images for pages using the Google Places ID fieldtype.
 *
 *
 * Copyright (C) 2021 by Cohere Digital (Adam Spruijt)
 * MIT License
 *
 */


use SKAgarwal\GoogleApi\PlacesApi;

$this->addHook("Page::getPlacesDetails", function ($event) {

	$page = $event->object;
	$event->return = null;

	if (!$page->google_places_id) {
		return;
	}

	$id = $page->google_places_id;

	$fields = \implode(',', config()->googlePlacesFields ?? []);
	$cache_id = $id . \md5($fields);

	if (!$id) {
		return;
	}

	$data = $this->cache->getFor('InputfieldGooglePlacesDetails', $cache_id, 3600 * 24, function () use ($id, $fields) {
		$googlePlacesApi = new PlacesApi(config()->googlePlacesApiKey);
		$response = $googlePlacesApi->placeDetails($id, [
			'fields' => $fields
		]);
		return $response;
	});
	$data = \json_decode($data);

	if ($data->result) {
		$data = $data->result;
	} else {
		$data = null;
	}

	$event->return = $data;
});


$this->addHook("Page::getPlacesPhotos", function ($event) {

	$page = $event->object;
	$event->return = null;

	$id =  $page->google_places_id ?: $event->arguments(0);
	$options = $event->arguments(0);

	if (!$id) {
		return;
	}

	$details = $page->getPlacesDetails($id);
	$photoReferences = [];

	foreach ($details->result->photos as $photo) {
		$attributions = (array) $photo->html_attributions;
		$photoReferences[$photo->photo_reference] = [
			'uid' => $photo->photo_reference,
			'height' => $photo->height,
			'width' => $photo->width,
			'attribution' => sanitizer()->markupToLine($attributions[0]),
		];
	}

	$urls = $this->cache->getFor('InputfieldGooglePlacesPhotos', $id, 3600, function () use ($photoReferences) {
		$photoUrls = [];
		foreach ($photoReferences as $uid => $photo) {
			$photoUrls[$uid]['urls'] = [
				'small' => $this->places->photo($uid, [
					'maxwidth' => 400,
					'maxheight' => 400,
				]),
				'medium' => $this->places->photo($uid, [
					'maxwidth' => 800,
					'maxheight' => 800,
				]),
				'large' => $this->places->photo($uid, [
					'maxwidth' => 1600,
					'maxheight' => 1600,
				]),
			];
		}

		return $photoUrls;
	});

	$photoReferences = \array_merge_recursive($photoReferences, $urls);

	// filter images
	if (isset($options['minheight']) && $options['minheight'] > 0) {
		$data = array_filter($data, function ($photo) use ($options) {
			return ($photo['height'] >= $options['minheight']);
		});
	}
	if (isset($options['minwidth']) && $options['minwidth'] > 0) {
		$data = array_filter($data, function ($photo) use ($options) {
			return ($photo['width'] >= $options['minwidth']);
		});
	}


	$event->return = \array_values($photoReferences);
});
