document.addEventListener('DOMContentLoaded', function () {
  // Obtener el elemento del calendario por su ID
  const calendarEl = document.getElementById('calendar');
  // Crear una instancia del calendario
  const calendar = new FullCalendar.Calendar(calendarEl, {
    // Configuración de la barra de herramientas del encabezado del calendario
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek'
    },
    // Vista inicial del calendario
    initialView: 'timeGridWeek',
    // Ocultar los días domingo (0) y sábado (6)
    hiddenDays: [0, 6],
    // Hora mínima y máxima en el calendario
    slotMinTime: '09:00',
    slotMaxTime: '22:00',
    // Función para obtener los eventos del calendario desde el servidor
    events: function (fetchInfo, successCallback, failureCallback) {
      // Realizar una solicitud AJAX para obtener los eventos
      $.ajax({
        url: 'get-events',
        type: 'GET',
        success: function (response) {
          // Formatear los eventos obtenidos en el formato requerido por FullCalendar
          const formattedEvents = response.map(function (event) {
            return {
              title: event.title,
              extendedProps: {
                event_type: event.event_type
              },
              start: event.date_start,
              end: event.date_end
            };
          });
          // Llamar a la función de éxito y pasar los eventos formateados
          successCallback(formattedEvents);
        },
        error: function (xhr, status, error) {
          // Manejar el error de la solicitud AJAX
          console.log(error);
          failureCallback(error);
        }
      });
    },

    // Función que se ejecuta al hacer clic en un evento del calendario
    eventClick: function (info) {
      var event = info.event;

      // Asignar el evento seleccionado a la variable
      selectedEvent = event;

      // Establecer los valores en el formulario de edición
      document.getElementById('edit-event-id').value = event.id;
      document.getElementById('edit-event-title').value = event.title;
      document.getElementById('edit-event-type').value = event.extendedProps.event_type;
      document.getElementById('edit-event-start').value = formatDate(event.start);
      document.getElementById('edit-event-end').value = formatDate(event.end);

      // Mostrar el modal de edición
      $('#editEventModal').modal('show');

      return false; // Evitar la acción predeterminada (navegación)
    }
  });

  // Renderizar el calendario en el elemento HTML
  calendar.render();

  // Agregar evento de clic al botón "Guardar"
  document.getElementById("btnSave").addEventListener("click", function () {
    // Obtener los datos del formulario utilizando FormData
    const form = document.getElementById("edit-event-form");
    const data = new FormData(form);
    console.log(data);
  });

  // Agregar evento de clic al botón "Cerrar" del formulario
  document.getElementById("btnClose").addEventListener("click", function () {
    // Ocultar el formulario
    $("#editEventModal").modal("hide");
  });

    // Agregar evento de clic al botón "Guardar"
    document.getElementById("btnUpdate").addEventListener("click", function () {
      const form = document.querySelector(".edit-event-form");
      const eventId = form.dataset.eventId;
      const url = form.getAttribute("action");
      const data = new FormData(form);
      data.append('action', 'update'); // Agregar el valor del botón "Guardar" al FormData

      $.ajax({
          url: url,
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          success: function (response) {
              console.log("Event updated successfully");
          },
          error: function (xhr, status, error) {
              console.log(error);
          }
      });
  });

  // Agregar evento de clic al botón "Eliminar"
  document.getElementById("btnDelete").addEventListener("click", function () {
      const form = document.querySelector(".edit-event-form");
      const eventId = form.dataset.eventId;
      const url = form.getAttribute("action");
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      $.ajax({
          url: url,
          type: "POST",
          data: {
              _method: "DELETE",
              _token: csrfToken,
              id: eventId,
              action: 'delete' // Agregar el valor del botón "Eliminar"
          },
          success: function (response) {
              console.log("Event deleted successfully");
          },
          error: function (xhr, status, error) {
              console.log(error);
          }
      });
  });


  // Función para formatear una fecha en el formato "YYYY-MM-DD HH:MM"
  function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${year}-${month}-${day}T${hours}:${minutes}`;
  }
});