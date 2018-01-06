class Icons{

  constructor(){
    this.cpf = document.getElementById("nome").lastElementChild.innerHTML
    this.nome = ''
  }

  constr_tabela(){
    const self = this

    const tabela_remedios = document.getElementById("tabela_remedios")
    let url = `http://localhost/Hora-Certa/php/require_remedio.php?cpf=${self.cpf}`
    fetch(url)
      .then(res => res.json())
      .then(info => {
        let obj = JSON.parse(info)
        let tabela_remedios_values = `<table><thead><tr><th>Nome</th><th>Horário</th></thead>`
        for(var k in obj) {
          tabela_remedios_values = tabela_remedios_values + (`<tr><td>${obj[k].nome}</td><td>${obj[k].horario}</td></tr>`)
        }
        tabela_remedios_values = tabela_remedios_values + (`</table>`)
        tabela_remedios.innerHTML = tabela_remedios_values
      })
  }

  constr_grafico(){
    const box = document.getElementById('box')
    let url = `http://localhost/Hora-Certa/php/require_remedio.php?cpf=${this.cpf}`
    fetch(url)
      .then(res => res.json())
      .then(info => {
        let obj = JSON.parse(info)
        document.getElementById("g_chart").style.visibility = "collapse";
        let select = `<select id = "sel" required>
                      <option value="sel" >Selecione</option>`
        for(var k in obj) {
          select = select + (`<option value="${obj[k].id}" >${obj[k].nome}</option>`)
        }
        select = select + (`</select>`)
        box.innerHTML = select
    })
  }

  constr_cadastr_remed(){
    const self = this

    const nome_paciente = document.getElementById("nome_cadastrar");
    const cadastrar = document.getElementById("cadastrar");

    nome_paciente.innerHTML = `<b>${this.nome}</b>`
    let url = `http://localhost/Hora-Certa/php/require_listaremedio.php`
    fetch(url)
    .then(res => res.json())
    .then(info => {
      let obj = JSON.parse(info)
      let select = `<select id = "sel_cadastrar" required>
                    <option value="sel">Selecione</option>`
      for(var k in obj) {
        select = select + (`<option value="${obj[k].id}">${obj[k].nome}</option>`)
      }
      select = select + (`</select>`)
      cadastrar.innerHTML = select
    })
    self.constr_tabela();
  }

  render(){
    const self = this

    self.constr_tabela();

    self.nome = document.getElementById("nome").firstElementChild.innerHTML
    self.constr_grafico()

    box.addEventListener('change', function(){
      let value = box.firstChild.value
      let url = `http://localhost/Hora-Certa/php/require_horario.php?cpf=${self.cpf}&&id_remedio=${value}`
      fetch(url)
      .then(res => res.json())
      .then(info => {
        let obj = JSON.parse(info)
        let graf = [
          ['Dia', 'Preescrito', 'Horário que o remédio foi tomado'],
        ]
        for(var k in obj) {
          graf.push([obj[k].dia, Number(`${obj[k].preescrito_h}.${obj[k].preescrito_m}`), Number(`${obj[k].hora}.${obj[k].minuto}`)])
        }
        if (typeof someObject == 'undefined') $.loadScript('https://www.gstatic.com/charts/loader.js', function(){
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
              var data = google.visualization.arrayToDataTable(
              graf
              );
              var options = {
                title: `${self.nome} - Horários do ${obj[0].remedio}`,
                curveType: 'function',
                legend: { position: 'bottom' }
              };
              var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
              chart.draw(data, options);
            }
        })
      })
    })
  }
}

// let icon = document.querySelectorAll('.material-icons')
let icons = new Icons()
icons.render()

jQuery.loadScript = function (url, callback) {
    jQuery.ajax({
        url: url,
        dataType: 'script',
        success: callback,
        async: true
    });
}
