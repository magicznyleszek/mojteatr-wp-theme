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
                    <div i-o-calendar-month class="month"><%= month %> <small><%= year %></small></div>
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
                console.debug('click', target, myCalendar);
                myCalendar.setExtras({
                    selectedEvents: target.events,
                    calendarModifiers: 'isPopupVisible'
                });
                $('#terminy-clndr').find('#terminy-clndr-close').click(() => {
                    myCalendar.setExtras({
                        selectedEvents: [],
                        calendarModifiers: ''
                    });
                });
            }
        },
        extras: {
            selectedEvents: [],
            calendarModifiers: ''
        }
    });
});
