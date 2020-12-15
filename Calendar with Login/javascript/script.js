const date = new Date();

const renderCalendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  document.querySelector(".date h1").innerHTML = months[date.getMonth()];
  
  document.querySelector(".year span").innerHTML = date.getFullYear();

  document.querySelector(".date p").innerHTML = new Date().toDateString();

  let days = "";

  for (let x = firstDayIndex; x > 0; x--) {
    days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDay; i++) {
    if (
      i === new Date().getDate() &&
      date.getMonth() === new Date().getMonth()
    ) {
      days += `<div class="today"  data-date="${months[date.getMonth()]} ${i} ${date.getFullYear()}" data-numericDate="${date.getFullYear()}-${date.getMonth() + 1}-${i}">${i}</div>`;
    } else {
      days += `<div data-date="${months[date.getMonth()]} ${i} ${date.getFullYear()}" data-numericDate="${date.getFullYear()}-${date.getMonth() + 1}-${i}">${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="next-date">${j}</div>`;
  }
  monthDays.innerHTML = days;

  let monthsSideBar = "";
  
  for(let z = 0; z < months.length; z++){
    monthsSideBar += `<div class="monthsSide" data-month="${z+1}">${months[z]}</div>`;
  }
  $('.monthsSideBar').html(monthsSideBar)

  let monthCount = document.getElementsByClassName('monthsSide');
  for (let index = 0; index < monthCount.length; index++) {
    monthCount[index].addEventListener('click', function(){
      console.log('inside');
        let month_no = this.dataset.month;
        console.log(month_no-1);
        date.setMonth(month_no-1);
        date.setDate(2);
        renderCalendar();
    });
  }

  $('.eventDate h1').html($(".today").attr("data-date"));
  $('.eventDate p').html($(".today").attr("data-numericDate"));

  $(document).on('click', '.days div', function(){
    $('.eventDate h1').html($(".activeDate").attr("data-date"));
    $('.eventDate p').html($(".activeDate").attr("data-numericDate"));
  });
  
};

$(document).on('click', '.days div', function(){
  $(this).addClass('activeDate').siblings().removeClass('activeDate');

  let event_date = $(this).attr('data-numericDate');
  console.log(event_date);
  $.ajax({
    type:'POST',
    url:'includes/event_handler.php',
    data:{
        'event-retrieve':1,
        'event_date': event_date
    },
    success: function(response){
        if(response.event_name){
          $('.eventTitle h3').html(response.event_name);
          $('.eventDesc p').html(response.event_desc);
        }else{
          $('.eventTitle h3').html('No Event Found');
          $('.eventDesc p').html('');
        }
      }
  });
});

document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
});

document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();
});

document.querySelector(".prevYear").addEventListener("click", () => {
  date.setFullYear(date.getFullYear() - 1);
  renderCalendar();
});

document.querySelector(".nextYear").addEventListener("click", () => {
  date.setFullYear(date.getFullYear() + 1);
  renderCalendar();
});

renderCalendar();

$('.today').click();

$('#event-add').on('click', () => {
  $("#exampleModal").modal("hide");
  let event_name = $('#event-name').val();
  let event_desc = $('#event-desc').val();
  let event_date = $('.eventDate p').html();
  $.ajax({
    type:'POST',
    url:'includes/event_handler.php',
    data:{
        'event-add':1,
        'event_name': event_name,
        'event_desc': event_desc,
        'event_date': event_date
    },
    success: function(response){
        swal({
          icon: "success",
          title:"Success",
          text: response,
          closeModal: true,
          timer: 2000,
        });
      }
   
  });
});


