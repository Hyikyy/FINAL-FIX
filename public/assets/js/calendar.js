(function() {
    "use strict";

    document.addEventListener('DOMContentLoaded', function() {
        const calendarBody = document.getElementById('calendar-body');
        const currentMonthYear = document.getElementById('current-month-year');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');

        let currentDate = new Date();

        function renderCalendar(year, month) {
            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);
            const daysInMonth = lastDayOfMonth.getDate();
            const startingDay = firstDayOfMonth.getDay();

            currentMonthYear.textContent = new Date(year, month).toLocaleDateString('id-ID', {
                month: 'long',
                year: 'numeric'
            });

            calendarBody.innerHTML = '';

            let dayCounter = 1;
            for (let i = 0; i < 6; i++) {
                const row = document.createElement('tr');

                for (let j = 0; j < 7; j++) {
                    const cell = document.createElement('td');

                    if (i === 0 && j < startingDay) {
                        cell.textContent = '';
                    } else if (dayCounter > daysInMonth) {
                        cell.textContent = '';
                    } else {
                        cell.textContent = dayCounter;
                        cell.dataset.day = dayCounter;
                        cell.dataset.month = month + 1;
                        cell.dataset.year = year;
                        cell.classList.add('calendar-day');

                        const eventDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(dayCounter).padStart(2, '0')}`;
                        const eventForDay = events.find(event => event.date === eventDate);

                        if (eventForDay) {
                            cell.classList.add('has-event');
                            cell.title = eventForDay.title;
                        }

                        dayCounter++;
                    }

                    row.appendChild(cell);
                }

                calendarBody.appendChild(row);

                if (dayCounter > daysInMonth) {
                    break;
                }
            }
        }

        // Inisialisasi kalender dengan bulan dan tahun saat ini
        renderCalendar(currentDate.getFullYear(), currentDate.getMonth());

        // Event listener untuk tombol bulan sebelumnya
        prevMonthBtn.addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });

        // Event listener untuk tombol bulan berikutnya
        nextMonthBtn.addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
    });


})()
