<div class="pb-2">
    <div class="is-pulled-right">
        <p class="">
            <a OnClick='$(".checkbox-attendanceScheduleEntries").prop("checked", true);'>Sélectionner
                tout</a> /
            <a
                OnClick='$(".checkbox-attendanceScheduleEntries").each(function (){$(this).prop("checked", !($(this).prop("checked"))); });'>Inverser</a>
        </p>
    </div>
    <div class="is-clearfix"></div>
</div>

@foreach ($attendanceSchedule->entries()->orderBy('schedule_date')->get()
    as $entry)
    <div class="list-item" id="scheduleEntry-{{ $entry->id }}">
        <div class="list-item-content">
            <div class="list-item-title">
                {{ $entry->schedule_date->format('d/m/Y') }}
            </div>
            <div class="list-item-description"> {{ $entry->name }}</div>
        </div>
        <div class="list-item-controls">
            <div class="buttons is-right">
                <button type="button" onclick="destroyScheduleEntry(this)"
                    data-route="{{ route('admin.attendances.schedules.entries.destroy', [$attendanceSchedule->id, $entry->id]) }}"
                    class="button is-danger is-light scheduleEntry-deleteButton">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
        </div>
    </div>
@endforeach

@if ($attendanceSchedule->id)
    <script type="text/javascript">
        function addScheduleEntry() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var scheduleEntryData = {
                name: $('#scheduleEntry-name').val(),
                schedule_date: $('#scheduleEntry-date').val(),
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.attendances.schedules.entries.store', $attendanceSchedule->id) }}',
                data: scheduleEntryData,
                dataType: 'json',
                success: function(data) {
                    refreshList();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function destroyScheduleEntry(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var scheduleEntryRoute = $(e).data("route");

            $.ajax({
                type: 'DELETE',
                url: scheduleEntryRoute,
                success: function(data) {
                    refreshList();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function importJson(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var importUri = "{{ route('admin.attendances.schedules.entries.import', $attendanceSchedule->id, '') }}" +
                "/" + type;

            $.ajax({
                type: 'POST',
                url: importUri,
                success: function(data) {
                    refreshList();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function refreshList() {
            var $request = $.get(
                "{{ route('admin.attendances.schedules.entries', $attendanceSchedule->id) }}"
            ); // make request

            $('#scheduleEntry-list').fadeOut();
            $request.done(function(data) { // success
                $('#scheduleEntry-list').html(data.html);
            });
            $request.always(function() {
                $('#scheduleEntry-list').fadeIn();
            });
        }
    </script>
@endif
