<?php

namespace App\Helpers;

/**
 * Element Helper.
 *
 * Provides convenient methods to render reusable UI elements
 */
class ElementHelper
{
    /**
     * Render an alert element.
     */
    public static function alert(string $message, string $type = 'primary', array $options = []): string
    {
        $data = array_merge([
            'message' => $message,
            'type' => $type,
        ], $options);

        return view('elements/alert', $data);
    }

    /**
     * Render a button element.
     */
    public static function button(string $text, array $options = []): string
    {
        $data = array_merge([
            'text' => $text,
        ], $options);

        return view('elements/button', $data);
    }

    /**
     * Render a card element.
     */
    public static function card(string $content, array $options = []): string
    {
        $data = array_merge([
            'content' => $content,
        ], $options);

        return view('elements/card', $data);
    }

    /**
     * Render a badge element.
     */
    public static function badge(string $text, string $type = 'primary', array $options = []): string
    {
        $data = array_merge([
            'text' => $text,
            'type' => $type,
        ], $options);

        return view('elements/badge', $data);
    }

    /**
     * Render a modal element.
     */
    public static function modal(string $id, string $title, string $content, array $options = []): string
    {
        $data = array_merge([
            'id' => $id,
            'title' => $title,
            'content' => $content,
        ], $options);

        return view('elements/modal', $data);
    }

    /**
     * Render a data table element.
     */
    public static function dataTable(string $id, array $columns, array $data, array $options = []): string
    {
        $data = array_merge([
            'id' => $id,
            'columns' => $columns,
            'data' => $data,
        ], $options);

        return view('elements/data_table', $data);
    }

    /**
     * Render a form input element.
     */
    public static function input(string $name, array $options = []): string
    {
        $data = array_merge([
            'name' => $name,
        ], $options);

        return view('elements/form_input', $data);
    }

    /**
     * Render a form select element.
     */
    public static function select(string $name, array $options = []): string
    {
        $data = array_merge([
            'name' => $name,
        ], $options);

        return view('elements/form_select', $data);
    }

    /**
     * Render a breadcrumb element.
     */
    public static function breadcrumb(array $items, array $options = []): string
    {
        $data = array_merge([
            'items' => $items,
        ], $options);

        return view('elements/breadcrumb', $data);
    }

    /**
     * Render a spinner element.
     */
    public static function spinner(array $options = []): string
    {
        return view('elements/spinner', $options);
    }

    /**
     * Quick success alert.
     */
    public static function success(string $message, bool $dismissible = true): string
    {
        return self::alert($message, 'success', [
            'dismissible' => $dismissible,
            'icon' => 'ti ti-check',
        ]);
    }

    /**
     * Quick error alert.
     */
    public static function error(string $message, bool $dismissible = true): string
    {
        return self::alert($message, 'danger', [
            'dismissible' => $dismissible,
            'icon' => 'ti ti-alert-triangle',
        ]);
    }

    /**
     * Quick warning alert.
     */
    public static function warning(string $message, bool $dismissible = true): string
    {
        return self::alert($message, 'warning', [
            'dismissible' => $dismissible,
            'icon' => 'ti ti-alert-circle',
        ]);
    }

    /**
     * Quick info alert.
     */
    public static function info(string $message, bool $dismissible = true): string
    {
        return self::alert($message, 'info', [
            'dismissible' => $dismissible,
            'icon' => 'ti ti-info-circle',
        ]);
    }

    /**
     * Quick primary button.
     */
    public static function primaryButton(string $text, ?string $href = null, array $options = []): string
    {
        $data = array_merge([
            'text' => $text,
            'type' => 'primary',
        ], $options);

        if ($href) {
            $data['href'] = $href;
        }

        return self::button($text, $data);
    }

    /**
     * Quick danger button.
     */
    public static function dangerButton(string $text, ?string $href = null, array $options = []): string
    {
        $data = array_merge([
            'text' => $text,
            'type' => 'danger',
        ], $options);

        if ($href) {
            $data['href'] = $href;
        }

        return self::button($text, $data);
    }

    /**
     * Quick success button.
     */
    public static function successButton(string $text, ?string $href = null, array $options = []): string
    {
        $data = array_merge([
            'text' => $text,
            'type' => 'success',
        ], $options);

        if ($href) {
            $data['href'] = $href;
        }

        return self::button($text, $data);
    }

    /**
     * Render a toast notification.
     */
    public static function toast(string $message, string $type = 'info', array $options = []): string
    {
        $data = array_merge([
            'message' => $message,
            'type' => $type,
        ], $options);

        return view('elements/toast', $data);
    }

    /**
     * Quick success toast.
     */
    public static function successToast(string $message, array $options = []): string
    {
        return self::toast($message, 'success', array_merge([
            'title' => 'Success!',
            'position' => 'top-center',
        ], $options));
    }

    /**
     * Quick error toast.
     */
    public static function errorToast(string $message, array $options = []): string
    {
        return self::toast($message, 'error', array_merge([
            'title' => 'Error!',
            'position' => 'top-center',
        ], $options));
    }

    /**
     * Quick warning toast.
     */
    public static function warningToast(string $message, array $options = []): string
    {
        return self::toast($message, 'warning', array_merge([
            'title' => 'Warning!',
            'position' => 'top-center',
        ], $options));
    }

    /**
     * Quick info toast.
     */
    public static function infoToast(string $message, array $options = []): string
    {
        return self::toast($message, 'info', array_merge([
            'title' => 'Info',
            'position' => 'top-center',
        ], $options));
    }
}
