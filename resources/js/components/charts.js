import 'chartjs-adapter-moment';
import { tailwindConfig, formatValue, hexToRGB } from '../utils';
import { Chart, LineController, LineElement, Filler, PointElement, LinearScale, TimeScale, Tooltip,} from 'chart.js';

export function populateCharts(response) {
  Chart.register(LineController, LineElement, Filler, PointElement, LinearScale, TimeScale, Tooltip);

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

  const chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: Object.keys(response).map(date => new Date(date)),
      datasets: [
        // Indigo line
        {
          data: Object.values(response),
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
            // unit: 'second',
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
  // let increment = 0;
  // const chartValue = document.getElementById('dashboard-card-05-value');
  // const chartDeviation = document.getElementById('dashboard-card-05-deviation');

  // const adddata = (value = NaN, prev) => {
  //   const { datasets } = chart.data;
  //   chart.data.labels.shift();
  //   chart.data.labels.push(new Date());
  //   datasets[0].data.shift();
  //   datasets[0].data.push(value);
  //   chart.update(0);
  //   if (!chartValue) return;
  //   const diff = ((value - prev) / prev) * 100;
  //   chartValue.innerHTML = value;
  //   if (!chartDeviation) return;
  //   if (diff < 0) {
  //     chartDeviation.style.backgroundColor = tailwindConfig().theme.colors.amber[500];
  //   } else {
  //     chartDeviation.style.backgroundColor = tailwindConfig().theme.colors.emerald[500];
  //   }
  //   chartDeviation.innerHTML = `${diff > 0 ? '+' : ''}${diff.toFixed(2)}%`;
  // };

  // const reload = () => {
  //   increment += 1;
  //   if (increment - 1 < result.data.length) {
  //     adddata(result.data[increment - 1], result.data[increment - 2]);
  //   } else {
  //     increment = 0;
  //     adddata(result.data[increment - 1], result.data[result.data.length - 1]);
  //   }
  // };

  // reload();

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