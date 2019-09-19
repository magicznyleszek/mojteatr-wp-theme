window.addEventListener('load', () => {
    moment.locale('pl');
    const myCalendar = $('#terminy-clndr').clndr({
        events: window.mojteatr.terminy,
        moment: moment,
        template: `
            <div i-o-calendar="<%= extras.calendarModifiers %>">
                <div i-o-calendar-popup>
                    <span i-o-calendar-control id="terminy-clndr-close">&times;</span>
                <% _.each(extras.selectedEvents, function (event) { %>
                    <a i-o-calendar-event href="<%= event.url %>">
                        <span i-o-calendar-eventdate><%= event.datePretty %></span>
                        <span i-o-calendar-eventtitle><%= event.title %></span>
                        <span i-o-calendar-eventcomment><%= event.comment %></span>
                    </a>
                <% }); %>
                </div>

                <div i-o-calendar-controls class="clndr-controls">
                    <div i-o-calendar-control="prev" class="clndr-previous-button">&larr;</div>
                    <div i-o-calendar-month>
                        <%= month %>
                        <small><%= year %></small>
                        <% if (!extras.isTodayVisible) { %>
                            <small i-o-calendar-todaybutton class="clndr-today-button">dzisiaj</small>
                        <% } %>
                    </div>
                    <div i-o-calendar-control="next" class="clndr-next-button">&rarr;</div>
                </div>

                <div i-o-calendar-grid class="clndr-grid">
                    <% _.each(daysOfTheWeek, function (day) { %>
                        <div i-o-calendar-cell="header"><%= day %></div>
                    <% }); %>
                    <% _.each(days, function (day) { %>
                        <div i-o-calendar-cell class="<%= day.classes %>"><%= day.day %></div>
                    <% }); %>
                </div>
            </div>
        `,
        clickEvents: {
            click: (target) => {
                if (target.events.length === 0) {
                    return;
                }

                let newExtras = myCalendar.options.extras;
                newExtras.selectedEvents = target.events;
                newExtras.calendarModifiers = 'isPopupVisible';
                myCalendar.setExtras(newExtras);

                $('#terminy-clndr').find('#terminy-clndr-close').click(() => {
                    let newExtras = myCalendar.options.extras;
                    newExtras.selectedEvents = [];
                    newExtras.calendarModifiers = '';
                    myCalendar.setExtras(newExtras);
                });
            },
            onMonthChange: (momentObj) => {
                let newExtras = myCalendar.options.extras;
                newExtras.isTodayVisible = momentObj.isSame(moment.now(), 'month')
                myCalendar.setExtras(newExtras);
            }
        },
        extras: {
            selectedEvents: [],
            calendarModifiers: '',
            isTodayVisible: true
        }
    });
});
