<script src="{{ asset('js/bulma-calendar.min.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function() {
        moment().format();

        var options = {
            displayMode: 'inline',
            minuteSteps: 1,
            weekStart: 1,
        }

        // Initialize all input of type date
        var calendars = bulmaCalendar.attach('.bulma-calendar', options);

        // Loop on each calendar initialized
        for (var i = 0; i < calendars.length; i++) {
            // Add listener to select event
            calendars[i].on('select', selected => {
                var input = selected.data.element;
                if (input.classList.contains('bulma-calendar-date')) {
                    var selectedDate = moment(selected.data.startDate);
                    input.value = selectedDate.format("YYYY-MM-DD");
                    console.log(input.value);
                }

                if (input.classList.contains('bulma-calendar-time')) {
                    var selectedTime = moment(selected.data.startTime);
                    input.value = selectedTime.format("HH:mm");
                    console.log(input.value);
                }
            });
        }
    });
</script>
