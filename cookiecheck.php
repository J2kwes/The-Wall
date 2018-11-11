<?php
/**
 * Created by PhpStorm.
 * User: stanh
 * Date: 16-4-2018
 * Time: 11:31
 */
$query = "SELECT userid FROM users WHERE userid = ? AND hash = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing.');
$stmt->bind_param('is', $userid,$hash) or die ('Error binding params');
$stmt->bind_result($userid) or die ('Error binding results.');
$userid = $_COOKIE['userid'];
$hash = $_COOKIE['hash'];
$stmt->execute() or die ('Error executing');
$fetch_succes = $stmt->fetch();