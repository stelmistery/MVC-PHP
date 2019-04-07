{% extends "base.html" %}

{% block title  %}Home{% endblock %}

{% block body %}

<h1>Welcome!</h1>
<p>Hello from Twig template, {{ name }}! </p>

<ul>
    {% for colour in colour %}
        <li>{{ colour }}</li>
    {% endfor %}
</ul>