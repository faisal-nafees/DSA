@if (Session::has('message'))
    <p hidden class="mb-0" id="txt">{!! Session::get('message') !!}</p>
    <script>
        var message = $("#txt").text();
        Toastify({
            text: message,
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            offset: {
                x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
            },
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #12ACFF, #5FC4FA)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif
@if (Session::has('success'))
    <p hidden class="mb-0" id="txt">{!! Session::get('success') !!}</p>
    <script>
        var message = $("#txt").text();
        Toastify({
            text: message,
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            offset: {
                x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
            },
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #61FF57, #96c93d)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif
@if (Session::has('warnings'))
    <p hidden class="mb-0" id="txt">{!! Session::get('warnings') !!}</p>

    <script>
        var message = $("#txt").text();
        Toastify({
            text: message,
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #FCF54E, #FCF000)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif
@if (Session::has('error'))
    <p hidden class="mb-0" id="txt">{!! Session::get('error') !!}</p>
    <script>
        var message = $("#txt").text();
        Toastify({
            text: message,
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right,#E75858, #F83E3E)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif
