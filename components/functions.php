
<?php

function e($value)
{
    return htmlspecialchars($value ? $value : '', ENT_QUOTES, 'UTF-8');
}

function TermsAndConditions($fieldName, $fieldValue, &$formErrors, $message)
{
    if ($fieldValue != 1) {
        $formErrors[$fieldName] = $message;
    }
}

function ValidateEmail($fieldName, $fieldValue, &$formErrors, $message)
{
    if (!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
        $formErrors[$fieldName] = $message;
    }
}

function ComparePasswords($fieldName, $fieldValueOne, $fieldValueTwo, &$formErrors, $message)
{
    if ($fieldValueOne !== $fieldValueTwo) {
        $formErrors[$fieldName] = $message;
    }
}

function RequiredField($fieldName, $fieldValue, &$formErrors)
{
    if ($fieldValue === "") {
        $formErrors[$fieldName] = "Field Must Not Be Empty!";
    }
}

function FormErrors($formField, &$FormErrors)
{
    if (isset($FormErrors[$formField])) {
        return e($FormErrors[$formField]);
    }
}

function OldFormData($fieldName, &$oldFormData)
{
    if (isset($oldFormData[$fieldName])) {
        return e($oldFormData[$fieldName]);
    }
}

function CreatedAt($time)
{
    $now = new DateTime();
    $createdAt = new DateTime($time);
    $diff = $now->diff($createdAt);

    if ($diff->d > 0) {
        return $diff->d . " day" . ($diff->d > 1 ? "s" : "") . " ago";
    } elseif ($diff->h > 0) {
        return $diff->h . " hour" . ($diff->h > 1 ? "s" : "") . " ago";
    } elseif ($diff->i > 0) {
        return $diff->i . " minute" . ($diff->i > 1 ? "s" : "") . " ago";
    } else {
        return "Just now";
    }
}

function PurifyHtml($value)
{
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    // Sanitize the input
    $cleanContent = $purifier->purify($value);

    return $cleanContent;
}
