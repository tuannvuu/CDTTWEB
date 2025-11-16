<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.5.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.5.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-products">
                                <a href="#endpoints-GETapi-products">Lấy danh sách sản phẩm (có phân trang)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-products">
                                <a href="#endpoints-POSTapi-products">Thêm một sản phẩm mới</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-products--id-">
                                <a href="#endpoints-GETapi-products--id-">Lấy thông tin chi tiết 1 sản phẩm</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-products--id-">
                                <a href="#endpoints-PUTapi-products--id-">Cập nhật thông tin sản phẩm</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">GET api/user</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: November 13, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-products">Lấy danh sách sản phẩm (có phân trang)</h2>

<p>
</p>



<span id="example-requests-GETapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;productname&quot;: &quot;B&agrave;n ph&iacute;m cơ Gaming RGB&quot;,
            &quot;price&quot;: &quot;350000.00&quot;,
            &quot;cateid&quot;: 11,
            &quot;brandid&quot;: 1,
            &quot;description&quot;: &quot;B&agrave;n ph&iacute;m cơ học c&oacute; đ&egrave;n LED RGB, thiết kế chống nước&quot;,
            &quot;fileName&quot;: &quot;banphim.jpg&quot;,
            &quot;category&quot;: null,
            &quot;brand&quot;: {
                &quot;id&quot;: 1,
                &quot;brandname&quot;: &quot;Logitech&quot;,
                &quot;description&quot;: &quot;Thương hiệu Thụy Sĩ chuy&ecirc;n sản xuất thiết bị ngoại vi m&aacute;y t&iacute;nh như chuột, b&agrave;n ph&iacute;m, webcam.&quot;,
                &quot;image&quot;: &quot;logitech.jpg&quot;,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2025-09-30T19:50:09.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;productname&quot;: &quot;B&agrave;n ph&iacute;m kh&ocirc;ng d&acirc;y&quot;,
            &quot;price&quot;: &quot;250000.00&quot;,
            &quot;cateid&quot;: 11,
            &quot;brandid&quot;: 1,
            &quot;description&quot;: &quot;Kết nối bluetooth, thời lượng pin l&acirc;u&quot;,
            &quot;fileName&quot;: &quot;banphim2.jpg&quot;,
            &quot;category&quot;: null,
            &quot;brand&quot;: {
                &quot;id&quot;: 1,
                &quot;brandname&quot;: &quot;Logitech&quot;,
                &quot;description&quot;: &quot;Thương hiệu Thụy Sĩ chuy&ecirc;n sản xuất thiết bị ngoại vi m&aacute;y t&iacute;nh như chuột, b&agrave;n ph&iacute;m, webcam.&quot;,
                &quot;image&quot;: &quot;logitech.jpg&quot;,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2025-09-30T19:50:09.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;productname&quot;: &quot;Chuột văn ph&ograve;ng Logitech&quot;,
            &quot;price&quot;: &quot;150000.00&quot;,
            &quot;cateid&quot;: 9,
            &quot;brandid&quot;: 1,
            &quot;description&quot;: &quot;Thiết kế nhỏ gọn, cổng USB&quot;,
            &quot;fileName&quot;: &quot;chuot.jpg&quot;,
            &quot;category&quot;: {
                &quot;cateid&quot;: 9,
                &quot;catename&quot;: &quot;Phụ kiện&quot;,
                &quot;cateimage&quot;: null,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: null,
                &quot;description&quot;: &quot;C&aacute;c loại phụ kiện c&ocirc;ng nghệ&quot;,
                &quot;image&quot;: &quot;phu_kien.jpg&quot;
            },
            &quot;brand&quot;: {
                &quot;id&quot;: 1,
                &quot;brandname&quot;: &quot;Logitech&quot;,
                &quot;description&quot;: &quot;Thương hiệu Thụy Sĩ chuy&ecirc;n sản xuất thiết bị ngoại vi m&aacute;y t&iacute;nh như chuột, b&agrave;n ph&iacute;m, webcam.&quot;,
                &quot;image&quot;: &quot;logitech.jpg&quot;,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2025-09-30T19:50:09.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;productname&quot;: &quot;Chuột chơi game RGB&quot;,
            &quot;price&quot;: &quot;220000.00&quot;,
            &quot;cateid&quot;: 9,
            &quot;brandid&quot;: 2,
            &quot;description&quot;: &quot;Cảm biến ch&iacute;nh x&aacute;c, đ&egrave;n LED đổi m&agrave;u&quot;,
            &quot;fileName&quot;: &quot;chuot2.jpg&quot;,
            &quot;category&quot;: {
                &quot;cateid&quot;: 9,
                &quot;catename&quot;: &quot;Phụ kiện&quot;,
                &quot;cateimage&quot;: null,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: null,
                &quot;description&quot;: &quot;C&aacute;c loại phụ kiện c&ocirc;ng nghệ&quot;,
                &quot;image&quot;: &quot;phu_kien.jpg&quot;
            },
            &quot;brand&quot;: {
                &quot;id&quot;: 2,
                &quot;brandname&quot;: &quot;Razer&quot;,
                &quot;description&quot;: &quot;Thương hiệu to&agrave;n cầu chuy&ecirc;n về thiết bị chơi game cao cấp: chuột, b&agrave;n ph&iacute;m, tai nghe RGB.&quot;,
                &quot;image&quot;: &quot;razer.jpg&quot;,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2025-09-30T19:50:09.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;productname&quot;: &quot;iPhone Air&quot;,
            &quot;price&quot;: &quot;15000000.00&quot;,
            &quot;cateid&quot;: 2,
            &quot;brandid&quot;: 3,
            &quot;description&quot;: &quot;Mỏng nhẹ, hiệu năng mạnh&quot;,
            &quot;fileName&quot;: &quot;ip_air.jpg&quot;,
            &quot;category&quot;: {
                &quot;cateid&quot;: 2,
                &quot;catename&quot;: &quot;Điện thoại&quot;,
                &quot;cateimage&quot;: null,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: null,
                &quot;description&quot;: &quot;Thiết bị điện tử, điện thoại, laptop&quot;,
                &quot;image&quot;: &quot;dien_thoai.jpg&quot;
            },
            &quot;brand&quot;: {
                &quot;id&quot;: 3,
                &quot;brandname&quot;: &quot;Apple&quot;,
                &quot;description&quot;: &quot;Tập đo&agrave;n c&ocirc;ng nghệ Mỹ nổi tiếng với c&aacute;c sản phẩm iPhone, iPad, MacBook, AirPods.&quot;,
                &quot;image&quot;: &quot;apple.jpg&quot;,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2025-09-30T19:50:09.000000Z&quot;
            }
        }
    ],
    &quot;first_page_url&quot;: &quot;http://localhost/api/products?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 19,
    &quot;last_page_url&quot;: &quot;http://localhost/api/products?page=19&quot;,
    &quot;links&quot;: [
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=1&quot;,
            &quot;label&quot;: &quot;1&quot;,
            &quot;page&quot;: 1,
            &quot;active&quot;: true
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=2&quot;,
            &quot;label&quot;: &quot;2&quot;,
            &quot;page&quot;: 2,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=3&quot;,
            &quot;label&quot;: &quot;3&quot;,
            &quot;page&quot;: 3,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=4&quot;,
            &quot;label&quot;: &quot;4&quot;,
            &quot;page&quot;: 4,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=5&quot;,
            &quot;label&quot;: &quot;5&quot;,
            &quot;page&quot;: 5,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=6&quot;,
            &quot;label&quot;: &quot;6&quot;,
            &quot;page&quot;: 6,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=7&quot;,
            &quot;label&quot;: &quot;7&quot;,
            &quot;page&quot;: 7,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=8&quot;,
            &quot;label&quot;: &quot;8&quot;,
            &quot;page&quot;: 8,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=9&quot;,
            &quot;label&quot;: &quot;9&quot;,
            &quot;page&quot;: 9,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=10&quot;,
            &quot;label&quot;: &quot;10&quot;,
            &quot;page&quot;: 10,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;...&quot;,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=18&quot;,
            &quot;label&quot;: &quot;18&quot;,
            &quot;page&quot;: 18,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=19&quot;,
            &quot;label&quot;: &quot;19&quot;,
            &quot;page&quot;: 19,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/products?page=2&quot;,
            &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
            &quot;page&quot;: 2,
            &quot;active&quot;: false
        }
    ],
    &quot;next_page_url&quot;: &quot;http://localhost/api/products?page=2&quot;,
    &quot;path&quot;: &quot;http://localhost/api/products&quot;,
    &quot;per_page&quot;: 5,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 5,
    &quot;total&quot;: 92
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products" data-method="GET"
      data-path="api/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products"
                    onclick="tryItOut('GETapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products"
                    onclick="cancelTryOut('GETapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-products">Thêm một sản phẩm mới</h2>

<p>
</p>



<span id="example-requests-POSTapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/products" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "proname=vmqeopfuudtdsufvyvddq"\
    --form "price=1"\
    --form "brandid=17"\
    --form "cateid=17"\
    --form "description=Dolores dolorum amet iste laborum eius est dolor."\
    --form "fileName=@C:\Users\Admin\AppData\Local\Temp\phpA2E6.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('proname', 'vmqeopfuudtdsufvyvddq');
body.append('price', '1');
body.append('brandid', '17');
body.append('cateid', '17');
body.append('description', 'Dolores dolorum amet iste laborum eius est dolor.');
body.append('fileName', document.querySelector('input[name="fileName"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-products">
</span>
<span id="execution-results-POSTapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products" data-method="POST"
      data-path="api/products"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products"
                    onclick="tryItOut('POSTapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products"
                    onclick="cancelTryOut('POSTapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>proname</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="proname"                data-endpoint="POSTapi-products"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-products"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brandid</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="brandid"                data-endpoint="POSTapi-products"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cateid</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cateid"                data-endpoint="POSTapi-products"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-products"
               value="Dolores dolorum amet iste laborum eius est dolor."
               data-component="body">
    <br>
<p>Example: <code>Dolores dolorum amet iste laborum eius est dolor.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fileName</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="fileName"                data-endpoint="POSTapi-products"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes. Example: <code>C:\Users\Admin\AppData\Local\Temp\phpA2E6.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-products--id-">Lấy thông tin chi tiết 1 sản phẩm</h2>

<p>
</p>



<span id="example-requests-GETapi-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;proname&quot;: &quot;B&agrave;n ph&iacute;m cơ Gaming RGB&quot;,
    &quot;price&quot;: &quot;350000.00&quot;,
    &quot;description&quot;: &quot;B&agrave;n ph&iacute;m cơ học c&oacute; đ&egrave;n LED RGB, thiết kế chống nước&quot;,
    &quot;cateid&quot;: 11,
    &quot;created_at&quot;: &quot;2025-09-30T19:58:59.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-30T19:58:59.000000Z&quot;,
    &quot;brandid&quot;: 1,
    &quot;fileName&quot;: &quot;banphim.jpg&quot;,
    &quot;stock_quantity&quot;: 11,
    &quot;category&quot;: null,
    &quot;brand&quot;: {
        &quot;id&quot;: 1,
        &quot;brandname&quot;: &quot;Logitech&quot;,
        &quot;description&quot;: &quot;Thương hiệu Thụy Sĩ chuy&ecirc;n sản xuất thiết bị ngoại vi m&aacute;y t&iacute;nh như chuột, b&agrave;n ph&iacute;m, webcam.&quot;,
        &quot;image&quot;: &quot;logitech.jpg&quot;,
        &quot;created_at&quot;: null,
        &quot;updated_at&quot;: &quot;2025-09-30T19:50:09.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products--id-" data-method="GET"
      data-path="api/products/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products--id-"
                    onclick="tryItOut('GETapi-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products--id-"
                    onclick="cancelTryOut('GETapi-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-products--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-products--id-">Cập nhật thông tin sản phẩm</h2>

<p>
</p>



<span id="example-requests-PUTapi-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/products/1" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "proname=vmqeopfuudtdsufvyvddq"\
    --form "price=1"\
    --form "brandid=17"\
    --form "cateid=17"\
    --form "description=Dolores dolorum amet iste laborum eius est dolor."\
    --form "fileName=@C:\Users\Admin\AppData\Local\Temp\phpA2F7.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('proname', 'vmqeopfuudtdsufvyvddq');
body.append('price', '1');
body.append('brandid', '17');
body.append('cateid', '17');
body.append('description', 'Dolores dolorum amet iste laborum eius est dolor.');
body.append('fileName', document.querySelector('input[name="fileName"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-products--id-">
</span>
<span id="execution-results-PUTapi-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-products--id-" data-method="PUT"
      data-path="api/products/{id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-products--id-"
                    onclick="tryItOut('PUTapi-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-products--id-"
                    onclick="cancelTryOut('PUTapi-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/products/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-products--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-products--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>proname</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="proname"                data-endpoint="PUTapi-products--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="PUTapi-products--id-"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brandid</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="brandid"                data-endpoint="PUTapi-products--id-"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cateid</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cateid"                data-endpoint="PUTapi-products--id-"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-products--id-"
               value="Dolores dolorum amet iste laborum eius est dolor."
               data-component="body">
    <br>
<p>Example: <code>Dolores dolorum amet iste laborum eius est dolor.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fileName</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="fileName"                data-endpoint="PUTapi-products--id-"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes. Example: <code>C:\Users\Admin\AppData\Local\Temp\phpA2F7.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
