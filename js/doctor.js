class Icons{

  constructor(icons){
    this.icons = icons
  }

  render(){
    Array.from(this.icons).map(icon => {
      icon.addEventListener('click', function(){
        let tr = this.parentNode.parentNode
        let cpf = tr.lastElementChild.innerHTML
        let button = this.getAttribute("name")
        if (button == 'graf'){
          console.log('oi')
        }
      })
    })
  }
}

// https://google-developers.appspot.com/chart/interactive/docs/gallery/linechart

const icon = document.querySelectorAll('.material-icons')

let icons = new Icons(icon)
icons.render()
