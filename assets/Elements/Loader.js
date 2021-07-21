

 export default class SpinningDots extends HTMLElement {

  constructor() {
   super();
   const width = 25
   const circleRadius = 2
   const circle = parseInt(this.getAttribute('dots'), 10) || 8
   const root = this.attachShadow({mode: 'open'})
   root.innerHTML =`<div>
    ${this.buildStyle(width, circleRadius * 2, circle)}
      ${this.buildTrail(width / 2 - circleRadius, circleRadius * 2)}
    ${this.buildCircle(width, circle, circleRadius)}
    </div>`
  }

     /**
      *
      * @param {number} rayon Rayon du cercle
      * @param {number} stroke Epaisseur du trait
      */
  buildTrail(rayon, stroke){
      const w =  rayon * 2 +stroke
         let dom =  `<svg class="trail" width="${w}" height="${w}" viewBox="0 0 ${w} ${w}">`
         dom += `<circle 
            cx="${w / 2}" 
            cy="${w / 2}" 
            r="${rayon}" 
            stroke="currentColor"
            stroke-width="${stroke}"
            fill="none"
            stroke-linecap="round"
            />`


         return dom + '</svg>'
  }
   /**
      * construit un svg
      * @param {number} width largeur du svg
      * @param {number} quantity nombre de cercle
      * @param {number} radius rayon de chaque cercle
      */
  buildCircle(width, quantity, radius){
        let dom =  `<svg class="circles" width="${width}" height="${width}" viewBox="0 0 ${width} ${width}">`
         const radius2 =  (width / 2 - radius)
         for (let i = 0; i < quantity; i++){
             const a = i * (Math.PI * 2) / quantity
             const x = radius2 * Math.sin(a) + width / 2
             const y = radius2  * Math.cos(a) + width / 2
             dom += `<circle cx="${x}" cy="${y}" r="${radius}" fill="currentColor"/>`
         }

         return dom + '</svg>'
}
  /**
   *
   * @param {number} width largeur de lelement
    * @param {number} stroke largeur du trait
   * @param {number} section largeur du trait
   */
  buildStyle(width, stroke, section){
      const perimeter = Math.PI * (width  - stroke)
    return `<style>
        :host {
        display: inline-block;
        }
        div {
        width: 28px;
        height: 28px;
        position: relative;
        }
        svg{
        position: absolute;
        top: 0;
        left: 0;
        }
        .circles {
          animation: spin 16s linear infinite;
        }
        .trail {
        stroke-dasharray: ${perimeter};
        stroke-dashoffset: ${perimeter + perimeter / section};
        animation: Trailspin 1.6s cubic-bezier(.5, .15, .5, .85) infinite;
        }
        .trail circle {
            animation: trail 1.6s cubic-bezier(.5, .15, .5, .85) infinite;
        }
        @keyframes spin {
            from {transform: rotate(0deg);}
            to{transform: rotate(360deg);}
            }
        @keyframes Trailspin {
            from {transform: rotate(0deg);}
            to{transform: rotate(720deg);}
            }
         @keyframes trail {
            0% {stroke-dashoffset: ${perimeter + perimeter / section};}
            50%{stroke-dashoffset: ${perimeter + 2.5 * perimeter / section};}
            100% {stroke-dashoffset: ${perimeter + perimeter / section};}
            }       
</style>`
  }
 }

