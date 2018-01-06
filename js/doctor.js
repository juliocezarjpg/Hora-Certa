class Icons{

  constructor(){
    this.icons = document.querySelectorAll('.material-icons')
    this.cpf = ''
    this.nome = ''
  }

  constr_tabela(){
    const self = this

    const tabela_remedios = document.getElementById("tabela_remedios")
    let url = `http://localhost/Hora-Certa/php/require_remedio.php?cpf=${this.cpf}`
    fetch(url)
      .then(res => res.json())
      .then(info => {
        let obj = JSON.parse(info)
        let tabela_remedios_values = `<table><thead><tr><th>Nome</th><th>Horário</th><th>Suspender</th></tr></thead>`
        for(var k in obj) {
          tabela_remedios_values = tabela_remedios_values + (`<tr><td>${obj[k].nome}</td><td>${obj[k].horario}</td><td><i class="material-icons" name="remov">clear</i></td></tr>`)
        }
        tabela_remedios_values = tabela_remedios_values + (`</table>`)
        tabela_remedios.innerHTML = tabela_remedios_values
      })
      this.icons = document.querySelectorAll('.material-icons')
      self.render()
  }

  constr_grafico(){
    const box = document.getElementById('box')
    document.getElementById("box").style.visibility = "visible";
    document.getElementById("cadastro_dos_remedios").style.visibility = "collapse";
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

    document.getElementById("box").style.visibility = "collapse";
    document.getElementById("g_chart").style.visibility = "collapse";
    document.getElementById("cadastro_dos_remedios").style.visibility = "visible";

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

    const botao_cadastrar = document.getElementById("botao_cadastrar");
    const horario_cadastrar = document.getElementById("horario_cadastrar");

    // Botoes
    Array.from(this.icons).map(icon => {
      icon.addEventListener('click', function(){
        let tr = this.parentNode.parentNode
        self.cpf = tr.lastElementChild.innerHTML
        self.nome = tr.firstElementChild.innerHTML
        let button = this.getAttribute("name")
        if (button == 'graf'){
          self.constr_grafico()
        }
        else if (button = 'remed'){
          self.constr_cadastr_remed()
        }

        // Mudança na Select box
        box.addEventListener('change', function(){
          let value = box.firstChild.value
          // Gráfico
          let url = `http://localhost/Hora-Certa/php/require_horario.php?cpf=${self.cpf}&&id_remedio=${value}`
          fetch(url)
            .then(res => res.json())
            .then(info => {
              let obj = JSON.parse(info)
              // console.log(obj)
              document.getElementById("g_chart").style.visibility = "visible";
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
              });
          })
        })
        botao_cadastrar.addEventListener('click', function(){

          let url = `http://localhost/Hora-Certa/php/cadastrar_remedio.php?cpf=${self.cpf}&&horario=${horario_cadastrar.value}&&id_remedio=${cadastrar.firstChild.value}`
          fetch(url)
          .then()

          self.constr_tabela();

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
