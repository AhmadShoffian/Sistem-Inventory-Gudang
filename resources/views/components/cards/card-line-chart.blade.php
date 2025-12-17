<div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-blueGray-700">
  <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full max-w-full flex-grow flex-1">
        <h6 class="uppercase text-blueGray-100 mb-1 text-xs font-semibold">
          Overview
        </h6>
        <h2 class="text-white text-xl font-semibold">Sales value</h2>
      </div>
    </div>
  </div>
  <div class="p-4 flex-auto">
    {{-- Chart --}}
    <div class="relative h-350-px">
      <canvas id="line-chart"></canvas>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("line-chart").getContext("2d");
    new Chart(ctx, {
      type: "line",
      data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
          {
            label: new Date().getFullYear(),
            backgroundColor: "#4c51bf",
            borderColor: "#4c51bf",
            data: [65, 78, 66, 44, 56, 67, 75],
            fill: false,
          },
          {
            label: new Date().getFullYear() - 1,
            backgroundColor: "#fff",
            borderColor: "#fff",
            data: [40, 68, 86, 74, 56, 60, 87],
            fill: false,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          labels: {
            fontColor: "white",
          },
          align: "end",
          position: "bottom",
        },
        tooltips: {
          mode: "index",
          intersect: false,
        },
        hover: {
          mode: "nearest",
          intersect: true,
        },
        scales: {
          xAxes: [{
            ticks: {
              fontColor: "rgba(255,255,255,.7)",
            },
            gridLines: {
              display: false,
              borderDash: [2],
              color: "rgba(33, 37, 41, 0.3)",
              zeroLineColor: "rgba(0, 0, 0, 0)",
              zeroLineBorderDash: [2],
            },
          }],
          yAxes: [{
            ticks: {
              fontColor: "rgba(255,255,255,.7)",
            },
            gridLines: {
              borderDash: [3],
              drawBorder: false,
              color: "rgba(255, 255, 255, 0.15)",
              zeroLineColor: "rgba(33, 37, 41, 0)",
              zeroLineBorderDash: [2],
            },
          }],
        },
      }
    });
  });
</script>
@endpush
