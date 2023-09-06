<template>
    <div class="flex flex-col col-span-full sm:col-span-12 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100">Real Time Value</h2>
            <div class="relative ml-2" x-data="{ open: false }" x-on:mouseenter="open = true" x-on:mouseleave="open = false">
                <button
                    class="block"
                    aria-haspopup="true"
                    x-bind:aria-expanded="open"
                    x-on:focus="open = true"
                    x-on:focusout="open = false" x-on:click.prevent
                >
                    <svg class="w-4 h-4 fill-current text-slate-400 dark:text-slate-500" viewBox="0 0 16 16">
                        <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"/>
                    </svg>
                </button>
                <div class="z-10 absolute bottom-full left-1/2 -translate-x-1/2">
                    <div
                        class="bg-white dark:bg-slate-700 dark:text-slate-100 border border-slate-200 dark:border-slate-600 p-3 rounded shadow-lg overflow-hidden mb-2"
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-out duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        x-cloak
                    >
                        <div class="text-xs text-center whitespace-nowrap">Built with <a class="underline" x-on:focus="open = true" x-on:focusout="open = false" href="https://www.chartjs.org/" target="_blank">Chart.js</a></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="px-5 py-3">
            <div class="flex items-start">
                <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2 tabular-nums"><span>{{ $filters.currencyUSD(total) }} ({{ eth.toFixed(3) }})</span></div>
                <div id="dashboard-card-05-deviation" class="text-sm font-semibold text-white px-1.5 rounded-full"></div>
            </div>
        </div>
        <div class="grow">
            <canvas id="dashboard-card-05" width="595" height="248"></canvas>
        </div>
    </div>
</template>

<script>
    // Import Chart.js
    import { Chart, LineController, LineElement, Filler, PointElement, LinearScale, TimeScale, Tooltip,} from 'chart.js';
    import 'chartjs-adapter-moment';
    // Import utilities
    import { tailwindConfig, formatValue, hexToRGB } from '../../utils';
    export default {
        props: ['total', 'eth'],
        mounted() {
            Chart.register(LineController, LineElement, Filler, PointElement, LinearScale, TimeScale, Tooltip);

            // A chart built with Chart.js 3
            // https://www.chartjs.org/
              const ctx = document.getElementById('dashboard-card-05');
              if (!ctx) return;

              const darkMode = localStorage.getItem('dark-mode') === 'true';

              const textColor = {
                light: '#94a3b8',
                dark: '#64748B'
              };

              const gridColor = {
                light: '#f1f5f9',
                dark: '#334155'
              };

              const tooltipTitleColor = {
                light: '#1e293b',
                dark: '#f1f5f9'
              };

              const tooltipBodyColor = {
                light: '#1e293b',
                dark: '#f1f5f9'
              };

              const tooltipBgColor = {
                light: '#ffffff',
                dark: '#334155'
              };

              const tooltipBorderColor = {
                light: '#e2e8f0',
                dark: '#475569'
              };

              let range = 35;
              let increment = 0;

              const result = {
                  data: [70000, 60000, 56000],
                  labels: ['2022-05-18 12:00:00', '2022-05-19 12:00:00', '2022-05-20 12:00:00']
              }

              // Fake real-time labels
              const generateDates = () => {
                const now = new Date();
                const dates = [];
                result.data.forEach((v, i) => {
                  dates.push(new Date(now));
                });
                return dates;
              };

              const labels = generateDates();
              const slicedData = result.data.slice(0, range);
              const slicedLabels = labels.slice(0, range).reverse();

              const chart = new Chart(ctx, {
                type: 'line',
                data: {
                  labels: slicedLabels,
                  datasets: [
                    // Indigo line
                    {
                      data: slicedData,
                      fill: true,
                      backgroundColor: `rgba(${hexToRGB(tailwindConfig().theme.colors.blue[500])}, 0.08)`,
                      borderColor: tailwindConfig().theme.colors.indigo[500],
                      borderWidth: 2,
                      tension: 0,
                      pointRadius: 0,
                      pointHoverRadius: 3,
                      pointBackgroundColor: tailwindConfig().theme.colors.indigo[500],
                      pointHoverBackgroundColor: tailwindConfig().theme.colors.indigo[500],
                      pointBorderWidth: 0,
                      pointHoverBorderWidth: 0,
                      clip: 20,
                    },
                  ],
                },
                options: {
                  layout: {
                    padding: 20,
                  },
                  scales: {
                    y: {
                      border: {
                        display: false,
                      },
                      suggestedMin: 30,
                      suggestedMax: 80,
                      ticks: {
                        maxTicksLimit: 5,
                        callback: (value) => formatValue(value),
                        color: darkMode ? textColor.dark : textColor.light,
                      },
                      grid: {
                        color: darkMode ? gridColor.dark : gridColor.light,
                      },
                    },
                    x: {
                      type: 'time',
                      time: {
                        parser: 'hh:mm:ss',
                        unit: 'second',
                        tooltipFormat: 'MMM DD, H:mm:ss a',
                        displayFormats: {
                          second: 'H:mm:ss',
                        },
                      },
                      border: {
                        display: false,
                      },
                      grid: {
                        display: false,
                      },
                      ticks: {
                        autoSkipPadding: 48,
                        maxRotation: 0,
                        color: darkMode ? textColor.dark : textColor.light,
                      },
                    },
                  },
                  plugins: {
                    legend: {
                      display: false,
                    },
                    tooltip: {
                      titleFont: {
                        weight: '600',
                      },
                      callbacks: {
                        label: (context) => formatValue(context.parsed.y),
                      },
                      titleColor: darkMode ? tooltipTitleColor.dark : tooltipTitleColor.light,
                      bodyColor: darkMode ? tooltipBodyColor.dark : tooltipBodyColor.light,
                      backgroundColor: darkMode ? tooltipBgColor.dark : tooltipBgColor.light,
                      borderColor: darkMode ? tooltipBorderColor.dark : tooltipBorderColor.light,
                    },
                  },
                  interaction: {
                    intersect: false,
                    mode: 'nearest',
                  },
                  animation: false,
                  maintainAspectRatio: false,
                },
              });

              // Fake real-time
              // For demo purposes only!
              const chartValue = document.getElementById('dashboard-card-05-value');
              const chartDeviation = document.getElementById('dashboard-card-05-deviation');

              const adddata = (value = NaN, prev) => {
                const { datasets } = chart.data;
                chart.data.labels.shift();
                chart.data.labels.push(new Date());
                datasets[0].data.shift();
                datasets[0].data.push(value);
                chart.update(0);
                if (!chartValue) return;
                const diff = ((value - prev) / prev) * 100;
                chartValue.innerHTML = value;
                if (!chartDeviation) return;
                if (diff < 0) {
                  chartDeviation.style.backgroundColor = tailwindConfig().theme.colors.amber[500];
                } else {
                  chartDeviation.style.backgroundColor = tailwindConfig().theme.colors.emerald[500];
                }
                chartDeviation.innerHTML = `${diff > 0 ? '+' : ''}${diff.toFixed(2)}%`;
              };

              const reload = () => {
                increment += 1;
                if (increment + range - 1 < result.data.length) {
                  adddata(result.data[increment + range - 1], result.data[increment + range - 2]);
                } else {
                  increment = 0;
                  range = 1;
                  adddata(result.data[increment + range - 1], result.data[result.data.length - 1]);
                }
              };

              reload();

              document.addEventListener('darkMode', (e) => {
                const { mode } = e.detail;
                if (mode === 'on') {
                  chart.options.scales.x.ticks.color = textColor.dark;
                  chart.options.scales.y.ticks.color = textColor.dark;
                  chart.options.scales.y.grid.color = gridColor.dark;
                  chart.options.plugins.tooltip.titleColor = tooltipTitleColor.dark;
                  chart.options.plugins.tooltip.bodyColor = tooltipBodyColor.dark;
                  chart.options.plugins.tooltip.backgroundColor = tooltipBgColor.dark;
                  chart.options.plugins.tooltip.borderColor = tooltipBorderColor.dark;
                } else {
                  chart.options.scales.x.ticks.color = textColor.light;
                  chart.options.scales.y.ticks.color = textColor.light;
                  chart.options.scales.y.grid.color = gridColor.light;
                  chart.options.plugins.tooltip.titleColor = tooltipTitleColor.light;
                  chart.options.plugins.tooltip.bodyColor = tooltipBodyColor.light;
                  chart.options.plugins.tooltip.backgroundColor = tooltipBgColor.light;
                  chart.options.plugins.tooltip.borderColor = tooltipBorderColor.light;
                }
                chart.update('none');
              });
        }
    }
</script>
