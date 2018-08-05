<?php

namespace App\Repository;

interface CommentInterface
{
	function getAll();

	function getById($id);

	function create(array $attributes);

	function update($id, array $attributes);

	function delete($id);
}