class Icons{

  constructor(icons){
    this.icons = icons
  }


  render(){
    const box = document.getElementById('box')
    const botao_cadastrar = document.getElementById("botao_cadastrar");
    const nome_paciente = document.getElementById("nome_cadastrar");
    const cadastrar = document.getElementById("cadastrar");
    const horario_cadastrar = document.getElementById("horario_cadastrar");
    const tabela_remedios = document.getElementById("tabela_remedios")

    // Botoes
    Array.from(document.querySelectorAll('.material-icons')).map(icon => {
      icon.addEventListener('click', function(){
        let tr = this.parentNode.parentNode
        let cpf = tr.lastElementChild.innerHTML
        let nome = tr.firstElementChild.innerHTML
        let button = this.getAttribute("name")
        if (button == 'graf'){
          // select box
          document.getElementById("box").style.visibility = "visible";
          document.getElementById("cadastro_dos_remedios").style.visibility = "hidden";
          let url = `http://localhost/Hora-Certa/php/require_remedio.php?cpf=${cpf}`
          fetch(url)
            .then(res => res.json())
            .then(info => {
              let obj = JSON.parse(info)
              // console.log(obj)
              document.getElementById("g_chart").style.visibility = "hidden";
              // console.log(`json: ${info}`)
              let select = `<select id = "sel" required>
                            <option value="sel" >Selecione</option>`
              for(var k in obj) {
                select = select + (`<option value="${obj[k].id}" >${obj[k].nome}</option>`)
              }
              select = select + (`</select>`)
              box.innerHTML = select
          })
        }
        else if (button = 'remed'){
          document.getElementById("box").style.visibility = "hidden";
          document.getElementById("g_chart").style.visibility = "hidden";
          document.getElementById("cadastro_dos_remedios").style.visibility = "visible";

          nome_paciente.innerHTML = `<b>${nome}</b>`
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
        url = `http://localhost/Hora-Certa/php/require_remedio.php?cpf=${cpf}`
        fetch(url)
          .then(res => res.json())
          .then(info => {
            let obj = JSON.parse(info)

            let tabela_remedios_values = `<table><thead><tr><th>Nome</th><th>Horário</th><th>Suspender</th></tr></thead>`
            for(var k in obj) {
              tabela_remedios_values = tabela_remedios_values + (`<tr><td>${obj[k].nome}</td><td>${obj[k].horario}</td><td><i class="material-icons" class="remov">clear</i></td></tr>`)
            }
            tabela_remedios_values = tabela_remedios_values + (`</table>`)
            tabela_remedios.innerHTML = tabela_remedios_values
          })
      }

        // Mudança na Select box
        box.addEventListener('change', function(){
          let value = box.firstChild.value
          // Gráfico
          let url = `http://localhost/Hora-Certa/php/require_horario.php?cpf=${cpf}&&id_remedio=${value}`
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
                //  console.log(k, obj[k].dia);
              }
              if (typeof someObject == 'undefined') $.loadScript('https://www.gstatic.com/charts/loader.js', function(){
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                    var data = google.visualization.arrayToDataTable(
                    graf
                    );
                    var options = {
                      title: `${nome} - Horários do ${obj[0].remedio}`,
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

          let url = `http://localhost/Hora-Certa/php/cadastrar_remedio.php?cpf=${cpf}&&horario=${horario_cadastrar.value}&&id_remedio=${cadastrar.firstChild.value}`
          fetch(url)
          .then()

          // console.log(document.querySelectorAll('.material-icons'))
          // console.log(url)

          url = `http://localhost/Hora-Certa/php/require_remedio.php?cpf=${cpf}`
          fetch(url)
            .then(res => res.json())
            .then(info => {
              let obj = JSON.parse(info)

              let tabela_remedios_values = `<table><thead><tr><th>Nome</th><th>Horário</th><th>Suspender</th></tr></thead>`
              for(var k in obj) {
                tabela_remedios_values = tabela_remedios_values + (`<tr><td>${obj[k].nome}</td><td>${obj[k].horario}</td><td><i class="material-icons" class="remov">clear</i></td></tr>`)
              }
              tabela_remedios_values = tabela_remedios_values + (`</table>`)
              tabela_remedios.innerHTML = tabela_remedios_values
            })
        })
      })
    })
  }
}

let icon = document.querySelectorAll('.material-icons')
let icons = new Icons(icon)
icons.render()


jQuery.loadScript = function (url, callback) {
    jQuery.ajax({
        url: url,
        dataType: 'script',
        success: callback,
        async: true
    });
}
