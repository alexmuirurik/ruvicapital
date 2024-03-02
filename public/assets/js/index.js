$(() => {
    $('.popover-dismiss').popover({
        trigger: 'focus'
    })
    
    Apex.grid = { padding: { right: 0, left: 0 } }
    Apex.dataLabels = { enabled: false }

    RenderDashboardChart()

    const toastLiveExample = document.getElementById('liveToast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show()
})


const displaySelectedImage = (event, elementId) => {
    const selectedImage = document.getElementById(elementId);
    const imageinput    = document.getElementById('profile_img_input')
    const fileInput     = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);
        imageinput.files = fileInput.files
    }
}

const randomizeArray = (arg) => {
    var array = arg.slice();
    var currentIndex = array.length, temporaryValue, randomIndex;

    while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

const RenderDashboardChart = () => {
    $.ajax({
        method: 'get',
        url:    '/ajaxchart',
        data:   'chart_data',
        success: (msg) => {
            const colorPalette = ['#00D8B6', '#008FFB', '#FEB019', '#FF4560', '#775DD0']
            const optionsBar = {
                chart: { type: 'bar', height: 380, width: '100%', stacked: true, },
                plotOptions: { bar: { columnWidth: '45%', } },
                colors: colorPalette,
                series: msg,
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                xaxis: { labels: { show: false }, axisBorder: { show: false }, axisTicks: { show: false }, },
                yaxis: { axisBorder: { show: false }, axisTicks: { show: false }, labels: { style: { colors: '#78909c' } } },
                title: { text: 'Monthly Sales', align: 'left', style: { fontSize: '18px' } }

            }
            const chartBar = new ApexCharts(document.querySelector('#bar'), optionsBar);
            chartBar.render();
        }
    })
    
}



const collapseSidebar = (e) => {
    let sidebar = $('#sidebarSupportedContent')
    if (sidebar.hasClass('d-none')) {
        sidebar.addClass('collapse show').removeClass('d-none')
    } else {
        sidebar.addClass('d-none').removeClass('collapse show')
    }
}

const removeAlertBox = (e) => {
    let alertBox = document.body.getElementsByClassName('header-alert')[0]
    alertBox.remove()
}

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "ms-5 btn btn-success",
        cancelButton: "me-5 btn btn-danger"
    },
    buttonsStyling: false
});

const makeApiRequest = (url, body = null) => {
    $.ajax({
        method: 'put',
        url: url,
        context: body
    }).done(function () {
        $(this).addClass("done");
    });
}

const confirmButtonClick = (event) => {
    event.preventDefault()
    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Do it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(event.target.id).submit()
            Swal.fire({
                title: "Awesome!",
                text: "We're Sending Your Request!",
                icon: "success"
            });
        }
    });
}
