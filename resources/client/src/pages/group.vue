<template>
  <q-page class="black flex">
    <div v-if="current != 'recent' && current != 'popular'" class="container">
      <div class="row" style="position: relative">
        <div class="col-12 col-md-6 woman">
          <svg
            v-if="!ssr"
             :class="{'gt-sm': !isFront}"
             xmlns:dc="https://purl.org/dc/elements/1.1/"
             xmlns:cc="https://creativecommons.org/ns#"
             xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"
             xmlns:svg="https://www.w3.org/2000/svg"
             xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             xmlns:sodipodi="https://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
             xmlns:inkscape="https://www.inkscape.org/namespaces/inkscape"
             width="375.56458"
             height="645.97107"
             viewBox="0 0 99.368125 170.91318"
             version="1.1"
             id="svg4123"
             inkscape:version="0.92.3 (2405546, 2018-03-11)"
             sodipodi:docname="woman.svg">
            <defs
               id="defs4117">
              <clipPath
                 clipPathUnits="userSpaceOnUse"
                 id="clipPath5638">
                <rect
                   style="fill:#ffcc00;fill-opacity:1;stroke:none;stroke-width:0.26458332;stroke-opacity:1"
                   id="rect5640"
                   width="200.98668"
                   height="216.4883"
                   x="4.0090423"
                   y="-186.49062" />
              </clipPath>
            </defs>
            <sodipodi:namedview
             id="base"
             pagecolor="#ffffff"
             bordercolor="#666666"
             borderopacity="1.0"
             inkscape:pageopacity="0.0"
             inkscape:pageshadow="2"
             inkscape:zoom="0.7"
             inkscape:cx="-169.78589"
             inkscape:cy="339.52767"
             inkscape:document-units="mm"
             inkscape:current-layer="g3823"
             showgrid="false"
             units="px"
             inkscape:snap-nodes="false"
             inkscape:lockguides="false"
             inkscape:window-width="1920"
             inkscape:window-height="1058"
             inkscape:window-x="1912"
             inkscape:window-y="-8"
             inkscape:window-maximized="1" />
            <metadata
              id="metadata4120">
              <rdf:RDF>
                <cc:Work
                  rdf:about="">
                  <dc:format>image/svg+xml</dc:format>
                  <dc:type
                    rdf:resource="https://purl.org/dc/dcmitype/StillImage" />
                  <dc:title></dc:title>
                </cc:Work>
              </rdf:RDF>
            </metadata>

            <g
               transform="translate(-21.980827,-126.41782)"
               style="display:inline;opacity:1"
               id="g3823"
               inkscape:groupmode="layer"
               inkscape:label="Front">
              <image
                 sodipodi:absref="/statics/front.jpg"
                 xlink:href="/statics/front.jpg"
                 inkscape:label="Front"
                 style="display:inline;opacity:1"
                 width="99.340736"
                 height="170.86606"
                 preserveAspectRatio="none"
                 id="image3837"
                 x="21.980827"
                 y="126.41782" />
              <g
                 inkscape:label="14"
                 @click="musculeClick(14)"
                 :class="{active:current==14}"
                 id="g3761">
                <path
                   sodipodi:nodetypes="cssssssssc"
                   inkscape:connector-curvature="0"
                   id="path3757"
                   d="m 53.760153,187.19445 c -0.453035,2.70877 -0.72543,4.23877 -1.160005,6.96757 -0.09239,0.58033 0.366849,1.4512 0.917282,1.86094 0.690848,0.51425 1.511798,0.70953 2.316105,0.40156 0.660668,-0.25296 1.397073,-0.95266 1.489928,-1.50436 0.448108,-2.6624 0.726041,-4.35151 1.112838,-7.09723 0.09018,-0.64015 -0.428971,-1.29154 -0.945546,-1.68023 -0.685879,-0.51609 -1.62593,-0.68147 -2.422886,-0.36273 -0.656808,0.26272 -1.232098,0.96236 -1.3077,1.41441 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                <path
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                   d="m 90.394842,186.20226 c 0.453035,2.70877 0.72543,4.23877 1.160005,6.96757 0.09239,0.58033 -0.366849,1.4512 -0.917282,1.86094 -0.690848,0.51425 -1.511798,0.70953 -2.316105,0.40156 -0.660668,-0.25296 -1.397073,-0.95266 -1.489928,-1.50436 -0.448108,-2.6624 -0.726041,-4.35151 -1.112838,-7.09723 -0.09018,-0.64015 0.428971,-1.29154 0.945546,-1.68023 0.685879,-0.51609 1.62593,-0.68147 2.422886,-0.36273 0.656808,0.26272 1.232098,0.96236 1.3077,1.41441 z"
                   id="path3759"
                   inkscape:connector-curvature="0"
                   sodipodi:nodetypes="cssssssssc" />
              </g>
              <g
                 inkscape:label="13"
                 @click="musculeClick(13)"
                 :class="{active:current==13}"
                 id="g3767">
                <path
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                   d="m 55.326263,171.67724 c -0.01122,2.74638 -0.03385,4.30027 -0.02363,7.06343 0.0022,0.58764 0.595603,1.37326 1.2048,1.68908 0.764601,0.39638 1.606274,0.45699 2.350538,0.0236 0.611351,-0.35597 1.225559,-1.16506 1.228422,-1.72451 0.01382,-2.69981 0.01631,-4.41164 -0.04379,-7.18382 -0.01401,-0.64632 -0.63122,-1.20567 -1.203614,-1.50617 -0.759991,-0.39899 -1.714405,-0.41094 -2.449679,0.0319 -0.605968,0.365 -1.061171,1.1481 -1.063043,1.60642 z"
                   id="path3763"
                   inkscape:connector-curvature="0"
                   sodipodi:nodetypes="cssssssssc" />
                <path
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                   d="m 85.894727,171.75647 c -0.01122,2.74638 -0.03385,4.30027 -0.02363,7.06343 0.0022,0.58764 0.595603,1.37326 1.2048,1.68908 0.764601,0.39638 1.606274,0.45699 2.350538,0.0236 0.611351,-0.35597 1.225559,-1.16506 1.228422,-1.72451 0.01382,-2.69981 0.01631,-4.41164 -0.04379,-7.18382 -0.01401,-0.64632 -0.63122,-1.20567 -1.203614,-1.50617 -0.759991,-0.39899 -1.714405,-0.41094 -2.449679,0.0319 -0.605968,0.365 -1.061171,1.1481 -1.063043,1.60642 z"
                   id="path3765"
                   inkscape:connector-curvature="0"
                   sodipodi:nodetypes="cssssssssc" />
              </g>
              <g
                 inkscape:label="4"
                 @click="musculeClick('pectoralis')"
                 :class="{active:current=='pectoralis'}"
                 id="g3775">
                <path
                   inkscape:label="4"
                   sodipodi:nodetypes="sssssssssssssssssssssssssssss"
                   inkscape:connector-curvature="0"
                   id="path3773"
                   d="m 72.406065,171.39376 c 0.303745,-0.25163 0.855946,-0.29407 1.181174,-0.0709 0.639354,0.43872 1.003011,0.96837 1.535528,1.41741 0.691138,0.5828 1.345535,1.24063 2.149739,1.65364 0.775601,0.39832 1.635652,0.67832 2.504093,0.75595 0.821108,0.0734 1.669946,-0.0377 2.456845,-0.28348 0.749878,-0.23419 1.562075,-0.51862 2.07887,-1.1103 0.386815,-0.44287 0.54334,-1.55915 0.614209,-1.65365 0.07087,-0.0945 0.251542,-2.52158 0.165365,-3.77976 -0.07494,-1.09406 -0.486203,-2.93363 -0.590587,-3.23642 -0.12282,-0.35627 -0.844489,-1.89048 -1.393788,-2.76395 -0.412525,-0.65598 -0.775786,-1.40812 -1.41741,-1.84263 -1.246686,-0.84426 -2.866765,-0.95144 -4.346726,-1.22843 -1.065158,-0.19935 -2.152913,-0.28932 -3.23642,-0.30711 -0.765184,-0.0126 -1.528417,0.0835 -2.291482,0.14175 -1.04069,0.0795 -2.084218,0.14198 -3.118302,0.28348 -0.951821,0.13024 -1.793552,0.21152 -2.834823,0.51972 -0.825203,0.24425 -1.470257,0.90745 -2.126115,1.46465 -0.64089,0.54448 -1.239234,1.14952 -1.748142,1.81901 -0.542662,0.71389 -1.034845,1.48344 -1.370163,2.31511 -0.332827,0.82549 -0.536947,1.71189 -0.614212,2.59859 -0.08217,0.94297 -0.03267,1.90922 0.165365,2.83482 0.21327,0.99678 0.429441,2.07928 1.086683,2.85844 0.559903,0.66377 1.417688,1.05665 2.244233,1.32292 0.745083,0.24003 1.560341,0.29552 2.338729,0.21261 0.918808,-0.0979 1.796389,-0.46319 2.645833,-0.82682 0.686952,-0.29407 1.37655,-0.62076 1.960751,-1.08669 0.461878,-0.36837 0.752016,-0.86918 1.157552,-1.27567 0.255886,-0.25649 0.507025,-0.48693 0.803201,-0.73229 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
              </g>
              <g
                 inkscape:label="9"
                 @click="musculeClick(9)"
                 :class="{active:current==9}"
                 id="g3783">
                <path
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                   d="m 73.067522,173.60255 c 2.024532,1.76332 2.536328,2.2086 3.89788,2.91751 1.446852,0.75332 3.000824,0.9429 4.618394,0.73232 0.929323,-0.12098 1.567694,-0.52215 2.799387,-1.15754 0.369779,-0.19076 0.710219,0.014 0.826822,0.41341 0.412415,1.41267 0.119272,2.53803 -0.02362,3.64983 -0.228777,1.77999 -0.880732,3.35538 -0.897693,5.14993 -0.01887,1.99612 0.967346,4.05261 0.897693,6.04761 -0.06104,1.74842 -0.42303,3.5496 -1.228423,5.10268 -1.186754,2.28847 -3.128408,4.15374 -5.10268,5.81138 -1.872506,1.57219 -4.088277,2.60629 -6.401972,2.64584 -2.298425,0.0393 -4.500878,-1.03459 -6.40197,-2.4096 -1.714449,-1.24001 -3.38303,-2.68431 -4.488468,-4.48847 -1.01218,-1.65195 -1.609732,-3.59101 -1.653645,-5.5279 -0.0511,-2.25368 1.330616,-4.49842 1.630021,-6.7327 0.236622,-1.76577 0.251449,-2.71152 -0.373809,-4.36689 -0.142387,-0.37697 -0.659352,-3.42587 -0.323085,-4.92896 0.131546,-0.588 0.597941,-0.65121 0.944941,-0.38979 1.143757,0.86169 1.757369,1.25952 2.976564,1.35836 1.437759,0.11655 2.930658,-0.17387 4.228607,-0.8032 1.565734,-0.75917 2.891499,-1.72803 4.075056,-3.02382 z"
                   id="path3781"
                   inkscape:connector-curvature="0"
                   sodipodi:nodetypes="csssssssssssssssssssc"
                   inkscape:label="9" />
              </g>
              <g
                 inkscape:label="8"
                 @click="musculeClick(8)"
                 :class="{active:current==8}"
                 id="g3789">
                <path
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                   d="m 84.924892,155.49746 c 1.71729,0.69831 3.528731,1.65585 4.543581,3.20723 1.182452,1.8076 1.348866,4.18814 1.30294,6.34765 -0.01757,0.8263 -0.131278,2.00122 -0.790346,2.49992 -0.586376,0.4437 -1.08269,0.31362 -1.697069,-0.0904 -1.119714,-0.73636 -1.54226,-2.57241 -1.845583,-3.87778 -0.361095,-1.554 -1.1335,-2.7193 -1.797497,-4.03578 -0.46621,-0.92433 -1.129891,-1.58938 -1.586914,-2.61423 -0.309659,-0.69439 -0.453148,-1.22736 0.05011,-1.55351 0.416365,-0.26983 1.361164,-0.0699 1.820774,0.11692 z"
                   id="path3785"
                   inkscape:connector-curvature="0"
                   sodipodi:nodetypes="ssssssssss" />
                <path
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                   d="m 61.017578,155.48571 c -1.71729,0.69831 -3.528731,1.65585 -4.543581,3.20723 -1.182452,1.8076 -1.348866,4.18814 -1.30294,6.34765 0.01757,0.8263 0.131278,2.00122 0.790346,2.49992 0.586376,0.4437 1.08269,0.31362 1.697069,-0.0904 1.119714,-0.73636 1.54226,-2.57241 1.845583,-3.87778 0.361095,-1.554 1.1335,-2.7193 1.797497,-4.03578 0.46621,-0.92433 1.129891,-1.58938 1.586914,-2.61423 0.309659,-0.69439 0.453148,-1.22736 -0.05011,-1.55351 -0.416365,-0.26983 -1.361164,-0.0699 -1.820774,0.11692 z"
                   id="path3787"
                   inkscape:connector-curvature="0"
                   sodipodi:nodetypes="ssssssssss" />
              </g>
              <g
                 inkscape:label="3"
                 @click="musculeClick('quadriceps')"
                 :class="{active:current=='quadriceps'}"
                 id="g3817">
                <path
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                   d="m 71.728459,215.21549 c 0,0 -0.453284,1.69068 -0.668174,2.53906 -0.323643,1.27773 -0.754576,2.53639 -0.935445,3.842 -0.209493,1.51224 -0.07988,3.05281 -0.167042,4.577 -0.0491,0.85868 -0.02002,1.72628 -0.294947,2.7142 -0.284778,1.02333 -0.6717,1.93703 -1.475713,2.63119 -1.075415,0.92848 -2.389496,1.53713 -3.81027,1.53679 -1.110556,-2.6e-4 -2.265999,-0.23701 -3.272372,-1.20271 -0.990808,-0.95076 -1.378686,-2.44882 -1.570209,-3.80859 -0.397317,-2.82085 0.03699,-4.93204 -0.267269,-6.9156 -0.545495,-3.55621 -1.853329,-6.37544 -2.271792,-9.65511 -0.186099,-1.45854 -0.454811,-2.98298 -0.100227,-4.40995 0.286146,-1.15155 0.766192,-2.42511 1.737252,-3.10701 0.895966,-0.62917 2.180123,-0.80639 3.240643,-0.53453 1.974572,0.50617 3.40975,2.29462 4.810852,3.77518 1.242241,1.31269 2.157012,2.90588 3.107008,4.44335 0.712446,1.15302 1.937705,3.57473 1.937705,3.57473 z"
                   id="path3813"
                   inkscape:connector-curvature="0"
                   sodipodi:nodetypes="csssssssssssssssc" />
                <path
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                   d="m 73.478842,215.23026 c 0,0 0.453284,1.69068 0.668174,2.53906 0.323643,1.27773 0.754576,2.53639 0.935445,3.842 0.209493,1.51224 0.07988,3.05281 0.167042,4.577 0.0491,0.85868 0.02002,1.72628 0.294947,2.7142 0.284778,1.02333 0.6717,1.93703 1.475713,2.63119 1.075415,0.92848 2.389496,1.53713 3.81027,1.53679 1.110556,-2.6e-4 2.265999,-0.23701 3.272372,-1.20271 0.990808,-0.95076 1.378686,-2.44882 1.570209,-3.80859 0.397317,-2.82085 -0.03699,-4.93204 0.267269,-6.9156 0.545495,-3.55621 1.853329,-6.37544 2.271792,-9.65511 0.186099,-1.45854 0.454811,-2.98298 0.100227,-4.40995 -0.286146,-1.15155 -0.766192,-2.42511 -1.737252,-3.10701 -0.895966,-0.62917 -2.180123,-0.80639 -3.240643,-0.53453 -1.974572,0.50617 -3.40975,2.29462 -4.810852,3.77518 -1.242241,1.31269 -2.157012,2.90588 -3.107008,4.44335 -0.712446,1.15302 -1.937705,3.57473 -1.937705,3.57473 z"
                   id="path3815"
                   inkscape:connector-curvature="0"
                   sodipodi:nodetypes="csssssssssssssssc" />
              </g>
            </g>
          </svg>
        </div>
        <div class="col-12 col-md-6 woman">
          <svg
            v-if="!ssr"
             :class="{'gt-sm': isFront}"
             xmlns:dc="https://purl.org/dc/elements/1.1/"
             xmlns:cc="https://creativecommons.org/ns#"
             xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"
             xmlns:svg="https://www.w3.org/2000/svg"
             xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             xmlns:sodipodi="https://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
             xmlns:inkscape="https://www.inkscape.org/namespaces/inkscape"
             width="375.56458"
             height="645.97107"
             viewBox="0 0 99.368125 170.91318"
             version="1.1"
             id="svg4123"
             inkscape:version="0.92.3 (2405546, 2018-03-11)"
             sodipodi:docname="woman.svg">
            <defs
               id="defs4117">
              <clipPath
                 clipPathUnits="userSpaceOnUse"
                 id="clipPath5638">
                <rect
                   style="fill:#ffcc00;fill-opacity:1;stroke:none;stroke-width:0.26458332;stroke-opacity:1"
                   id="rect5640"
                   width="200.98668"
                   height="216.4883"
                   x="4.0090423"
                   y="-186.49062" />
              </clipPath>
            </defs>
            <sodipodi:namedview
             id="base"
             pagecolor="#ffffff"
             bordercolor="#666666"
             borderopacity="1.0"
             inkscape:pageopacity="0.0"
             inkscape:pageshadow="2"
             inkscape:zoom="0.7"
             inkscape:cx="-169.78589"
             inkscape:cy="339.52767"
             inkscape:document-units="mm"
             inkscape:current-layer="g3823"
             showgrid="false"
             units="px"
             inkscape:snap-nodes="false"
             inkscape:lockguides="false"
             inkscape:window-width="1920"
             inkscape:window-height="1058"
             inkscape:window-x="1912"
             inkscape:window-y="-8"
             inkscape:window-maximized="1" />
            <metadata
              id="metadata4120">
              <rdf:RDF>
                <cc:Work
                  rdf:about="">
                  <dc:format>image/svg+xml</dc:format>
                  <dc:type
                    rdf:resource="https://purl.org/dc/dcmitype/StillImage" />
                  <dc:title></dc:title>
                </cc:Work>
              </rdf:RDF>
            </metadata>

            <g
               inkscape:label="Back"
               inkscape:groupmode="layer"
               id="layer1"
               style="display:inline;opacity:1"
               transform="translate(-21.980827,-126.41782)">
              <image
                 sodipodi:absref="/statics/back.jpg"
                 xlink:href="/statics/back.jpg"
                 style="display:inline"
                 inkscape:label="Back"
                 width="99.368126"
                 height="170.91318"
                 preserveAspectRatio="none"
                 id="image3848"
                 x="21.980827"
                 y="126.41782" />
              <g
                 id="g15"
                 inkscape:label="15"
                 @click="musculeClick(15)"
                 :class="{active:current==15}"
                 transform="translate(-69.490077,0.40090429)">
                <path
                   sodipodi:nodetypes="sssssssssssss"
                   inkscape:connector-curvature="0"
                   id="path5648"
                   d="m 125.81882,179.73286 c -0.53882,-0.0343 -1.07081,-0.18915 -1.43436,-0.46961 -0.37409,-0.28859 -0.92889,-1.07926 -0.94232,-1.55154 -0.0831,-2.92257 0.11425,-7.05216 0.0115,-9.78832 -0.0276,-0.73505 0.25009,-1.27236 0.53953,-1.62351 0.37708,-0.45747 0.5437,-0.61724 1.05876,-0.9108 0.52638,-0.30001 1.54629,-0.34282 2.13782,-0.14149 0.63477,0.21604 0.90347,0.39259 1.36346,1.017 0.6142,0.83374 0.45423,1.87209 0.4949,3.34159 0.045,1.62758 0.0427,3.97371 0.0451,5.93651 0.001,1.15228 -0.0752,2.33312 -0.33983,2.95626 -0.21439,0.50487 -0.53781,0.79794 -1.04181,1.01437 -0.569,0.24434 -1.27476,0.25893 -1.89275,0.21954 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                <path
                   sodipodi:nodetypes="sssssssssssss"
                   inkscape:connector-curvature="0"
                   id="path5648-8"
                   d="m 154.57913,179.75292 c -0.53882,-0.0343 -1.07081,-0.18915 -1.43436,-0.46961 -0.37409,-0.28859 -0.92889,-1.07926 -0.94232,-1.55154 -0.0831,-2.92257 0.11425,-7.05216 0.0115,-9.78832 -0.0276,-0.73505 0.25009,-1.27236 0.53953,-1.62351 0.37708,-0.45747 0.5437,-0.61724 1.05876,-0.9108 0.52638,-0.30001 1.54629,-0.34282 2.13782,-0.14149 0.63477,0.21604 0.90347,0.39259 1.36346,1.017 0.6142,0.83374 0.45423,1.87209 0.4949,3.34159 0.045,1.62758 0.0427,3.97371 0.0451,5.93651 0.001,1.15228 -0.0752,2.33312 -0.33983,2.95626 -0.21439,0.50487 -0.53781,0.79794 -1.04181,1.01437 -0.569,0.24434 -1.27476,0.25893 -1.89275,0.21954 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
              </g>
              <g
                 id="g5809"
                 inkscape:label="12"
                 @click="musculeClick(12)"
                 :class="{active:current==12}"
                 transform="translate(-69.490077,0.40090429)">
                <ellipse
                   inkscape:label="12"
                   ry="4.4099469"
                   rx="5.2117558"
                   cy="191.69577"
                   cx="141.25194"
                   id="path5775"
                   style="opacity:1;fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
              </g>
              <g
                 id="g5803"
                 transform="rotate(-8.942355,46.506183,610.35846)"
                 @click="musculeClick(10)"
                 :class="{active:current==10}"
                 inkscape:label="10">
                <path
                   inkscape:label="10"
                   sodipodi:nodetypes="csssssssssssscssssc"
                   inkscape:connector-curvature="0"
                   id="path5642"
                   d="m 145.75707,164.18858 c 0,0 -0.80533,1.80086 -0.96857,2.72852 -0.26203,1.48911 -0.0564,2.94316 0.0236,4.45303 0.035,0.66038 0.21838,1.53327 0.18899,1.98438 -0.0332,0.51024 -0.33937,1.62323 -0.8977,2.17336 -0.57913,0.57062 -1.46257,0.78585 -2.26786,0.89769 -1.23865,0.17202 -2.52219,-0.0634 -3.73251,-0.37797 -0.73053,-0.18987 -1.45442,-0.47368 -2.07887,-0.8977 -0.33167,-0.22521 -0.61435,-0.36194 -0.76777,-0.73232 -0.0784,-0.18915 -0.11486,-0.53014 -0.0827,-0.73233 0.12758,-0.80172 0.58129,-1.52232 0.75596,-2.31511 0.20132,-0.91379 0.28431,-1.85302 0.33072,-2.78757 0.0414,-0.83382 0.0918,-1.59821 -0.0472,-2.42141 -0.13513,-0.80047 -0.75595,-2.39779 -0.75595,-2.39779 0,0 0.52259,-0.67645 0.85044,-0.94494 0.69377,-0.56816 1.45828,-1.10566 2.31511,-1.37016 0.93494,-0.28861 1.96304,-0.34298 2.92931,-0.18899 0.83754,0.13348 1.66307,0.46504 2.36235,0.94494 0.74425,0.51076 1.84265,1.98437 1.84265,1.98437 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
              </g>
              <g
                 id="g5736"
                 inkscape:label="7"
                 @click="musculeClick(7)"
                 :class="{active:current==7}"
                 transform="translate(-69.490077,0.40090429)">
                <path
                   sodipodi:nodetypes="ssssssssssssss"
                   inkscape:connector-curvature="0"
                   id="path5644"
                   d="m 147.88613,185.92517 c -0.089,0.19553 -0.36959,0.15366 -0.43528,0.005 -0.4668,-1.05401 -0.56854,-1.69033 -0.67797,-2.32338 -0.27632,-1.59852 -0.009,-3.11724 -0.10635,-4.73652 -0.10225,-1.69643 -0.46829,-3.39496 -0.57877,-5.09087 -0.11364,-1.74444 -0.17033,-4.52974 0,-5.24442 0.18863,-0.79147 0.52581,-2.3216 1.08668,-3.35454 0.5129,-0.9446 1.1421,-1.9007 2.03162,-2.50409 0.43696,-0.2964 0.93061,-0.45577 1.26133,-0.45577 0.33073,0 1.03065,0.47232 1.21746,1.02225 0.47177,1.38883 -0.1588,4.48261 -0.20282,4.77817 -0.32837,2.20448 -1.20413,6.88717 -1.37017,8.76264 -0.17451,1.97102 -0.56654,4.28317 -1.23653,6.30342 -0.33725,1.01693 -0.45667,1.66781 -0.9892,2.83778 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                <path
                   sodipodi:nodetypes="sssssssssssss"
                   inkscape:connector-curvature="0"
                   id="path5646"
                   d="m 130.65628,185.82617 c 0.55061,-0.83599 0.85647,-1.9738 1.00936,-2.7624 0.16408,-0.84626 0.63859,-3.44905 1.0985,-5.23177 0.48146,-1.86627 1.61284,-4.09416 1.84263,-5.56417 0.18494,-1.1831 0.55316,-3.36901 0.4529,-4.49347 -0.0962,-1.07886 -0.4796,-2.92029 -1.30049,-4.09664 -0.45436,-0.65113 -1.12147,-1.17769 -1.9345,-1.55367 -0.3467,-0.16034 -1.03878,-0.0601 -1.25897,0.34981 -0.93729,1.74501 -0.51516,3.11614 -0.65261,4.79389 -0.19194,2.34296 -0.0271,4.7517 -0.25546,7.17344 -0.21044,2.2314 0.0542,4.14546 0.0472,7.92568 -10e-4,0.7572 -0.11168,2.39348 0.48261,3.43531 0.09,0.15773 0.37651,0.16418 0.46884,0.024 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
              </g>
              <g
                 id="g5748"
                 inkscape:label="6"
                 @click="musculeClick(6)"
                 :class="{active:current==6}"
                 transform="translate(-69.490077,0.40090429)">
                <path
                   sodipodi:nodetypes="cssssssssccc"
                   inkscape:connector-curvature="0"
                   id="path5658"
                   d="m 147.64695,242.94937 c -0.6213,0.82449 -0.94807,1.8497 -0.94494,2.88207 0.005,1.76981 0.0499,2.73982 0.0945,4.34673 0.0239,0.85997 0.46976,1.71769 1.03944,2.36235 0.69216,0.78326 1.57779,1.31431 2.6104,1.47647 0.9265,0.1455 1.98959,-0.11277 2.63402,-0.38979 0.79105,-0.34005 1.75167,-1.05514 1.86625,-2.03162 0.2956,-2.51923 0.38442,-5.0883 -0.0827,-7.41778 -0.16491,-0.82248 -0.84603,-1.71312 -1.54734,-2.17337 -0.75419,-0.49496 -1.69708,-0.78866 -2.59859,-0.75595 -1.18838,0.15714 -2.40142,0.83143 -3.07105,1.70089 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.26458332px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" />
                <path
                   sodipodi:nodetypes="cssssssssccc"
                   inkscape:connector-curvature="0"
                   id="path5658-3"
                   d="m 127.21539,243.17244 c -0.6213,0.82449 -0.94807,1.8497 -0.94494,2.88207 0.005,1.76981 0.0499,2.73982 0.0945,4.34673 0.0239,0.85997 0.46976,1.71769 1.03944,2.36235 0.69216,0.78326 1.57779,1.31431 2.6104,1.47647 0.9265,0.1455 1.98959,-0.11277 2.63402,-0.38979 0.79105,-0.34005 1.75167,-1.05514 1.86625,-2.03162 0.2956,-2.51923 0.38442,-5.0883 -0.0827,-7.41778 -0.16491,-0.82248 -0.84603,-1.71312 -1.54734,-2.17337 -0.75419,-0.49496 -1.69708,-0.78866 -2.59859,-0.75595 -1.18838,0.15714 -2.40142,0.83143 -3.07105,1.70089 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.26458332px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" />
              </g>
              <g
                 id="g5744"
                 inkscape:label="5"
                 @click="musculeClick('hamstrings')"
                 :class="{active:current=='hamstrings'}"
                 transform="translate(-69.490077,0.40090429)">
                <path
                   sodipodi:nodetypes="cssssssssssscsssssc"
                   inkscape:connector-curvature="0"
                   id="path5654"
                   d="m 139.52046,218.71165 c -0.18899,0.14174 -1.29324,1.76908 -1.65365,2.78758 -0.25485,0.72018 -0.2455,1.50867 -0.33073,2.26785 -0.13395,1.19315 -0.0693,2.40938 -0.28348,3.59077 -0.23388,1.28993 -0.4338,2.64295 -1.08668,3.77977 -0.48818,0.85003 -1.16624,1.66569 -2.03162,2.12611 -0.98745,0.52536 -2.19944,0.72102 -3.30729,0.56697 -0.7954,-0.1106 -1.61491,-0.46237 -2.17337,-1.03944 -0.68168,-0.7044 -1.01164,-1.72761 -1.18117,-2.69308 -0.20745,-1.18144 0.18144,-2.34433 0.15355,-3.54352 -0.0262,-1.12495 -0.22342,-2.29073 -0.4016,-3.40179 -0.23183,-1.44559 -0.37405,-2.22078 -0.76633,-3.63131 -0.0894,-0.32151 -0.35579,-1.61311 -0.35579,-1.61311 0,0 0.92752,-1.81032 1.6064,-2.55134 0.72131,-0.78734 1.56778,-1.52142 2.55134,-1.93713 0.96836,-0.40929 2.0198,-0.59179 3.11831,-0.47247 0.7077,0.0769 1.89574,0.82555 2.69308,1.46466 0.89707,0.71905 1.59911,1.63635 2.26785,2.59859 0.58593,0.84309 1.18118,1.70089 1.18118,1.70089 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                <path
                   sodipodi:nodetypes="cssssssssssscssscc"
                   inkscape:connector-curvature="0"
                   id="path5656"
                   d="m 142.7805,218.80614 c 0,0 0.60685,1.0874 1.13393,2.12612 0.50051,0.98636 0.51211,1.87606 0.66146,2.83482 0.18238,1.17083 0.13314,2.36816 0.28348,3.54353 0.15913,1.24408 0.27563,2.25323 0.75595,3.26004 0.43001,0.90135 1.0366,1.77275 1.84264,2.36235 0.73198,0.53542 1.91155,0.84813 2.55134,0.94494 0.78691,0.11908 2.10763,0.11727 2.97656,-0.37797 0.62403,-0.35566 0.96971,-1.07547 1.32292,-1.70089 0.32361,-0.57301 0.46068,-1.34654 0.5079,-2.19699 0.0472,-0.85044 -0.1272,-3.04823 -0.0354,-4.03962 0.11835,-1.27858 0.42852,-3.2123 0.85045,-4.77195 0.21469,-0.79359 0.75595,-2.07887 0.85044,-2.3151 0.0945,-0.23624 -0.78555,-1.66458 -1.37016,-2.36236 -0.94018,-1.12218 -1.98346,-2.32162 -3.35454,-2.83482 -1.00308,-0.37546 -2.18792,-0.35828 -3.2128,-0.0472 -1.30005,0.39461 -2.37296,1.37577 -3.35454,2.3151 -0.96244,0.99514 -2.40963,3.26 -2.40963,3.26 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
              </g>
              <g
                 id="g5794"
                 inkscape:label="2"
                 @click="musculeClick('glutes')"
                 :class="{active:current=='glutes'}"
                 transform="translate(-69.490077,0.40090429)">
                <path
                   inkscape:label="2"
                   sodipodi:nodetypes="csssssssssssscssssssssssssc"
                   inkscape:connector-curvature="0"
                   id="path5652"
                   d="m 141.12112,200.71962 c 0,0 0.94301,-1.90226 1.51764,-2.51318 0.66908,-0.71134 1.4317,-1.37912 2.31511,-1.79538 1.29957,-0.61235 2.55196,-0.90801 3.98782,-0.86143 1.34397,0.0436 3.14741,0.6974 3.56073,0.93111 0.94019,0.53163 2.52262,2.08659 2.80141,2.41819 0.52297,0.62203 1.36393,2.09182 1.55629,3.418 0.20274,1.3977 -0.008,2.88876 -0.51972,4.20499 -0.56089,1.44175 -1.51126,2.78149 -2.69308,3.77976 -0.85558,0.72269 -1.92938,1.22692 -3.02381,1.46466 -1.3239,0.28759 -2.7388,0.1906 -4.06324,-0.0945 -0.98657,-0.21237 -1.78255,-0.61143 -2.60383,-1.19787 -0.67163,-0.47958 -1.35344,-1.15744 -1.83739,-1.82594 -0.42613,-0.58862 -1.08668,-1.88988 -1.08668,-1.88988 0,0 -0.56687,1.34711 -0.95641,1.92043 -0.5198,0.76503 -1.1947,1.37101 -1.9314,1.85647 -0.86316,0.5688 -2.10409,1.13872 -3.30155,1.27853 -1.51153,0.17648 -2.74142,0.0456 -4.18493,-0.43619 -1.00435,-0.33523 -2.08023,-0.98643 -2.84055,-1.72333 -0.82834,-0.80283 -1.44685,-1.73393 -1.80923,-2.82909 -0.44662,-1.34972 -0.83467,-2.91448 -0.6147,-4.31905 0.17376,-1.10952 0.65378,-2.18316 1.27567,-3.1183 0.703,-1.05712 1.59655,-2.05329 2.69308,-2.69308 1.27061,-0.74136 2.78115,-1.18166 4.25223,-1.18118 1.29152,4.2e-4 2.57814,0.46028 3.73252,1.03944 0.94324,0.47323 1.76033,1.18847 2.50409,1.93712 0.53058,0.53407 1.26993,2.2297 1.26993,2.2297 z"
                   style="fill:#f95701;fill-opacity:0.4;stroke:none;stroke-width:0.065;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
              </g>
            </g>

          </svg>
        </div>
        <q-btn
          type="a"
          id="turn-model"
          class="lt-md"
          color="primary"
          icon="cached"
          size="md"
          @click="isFront = !isFront"
          round
        />

      </div>
    </div>
    <div class="container overflow-hidden" v-if="current">
      <a-video-group
      v-if="group"
      :title="group.title"
      :items="group.videos"
      />
    </div>
  </q-page>
</template>

<style lang="scss">
#turn-model {
  position: absolute;
  right: 20px;
  bottom: 50%;
}
.woman{
  text-align: center;
  svg{
    width:100%;
    max-width: 900px;
  }
  g {
    opacity: 0.1;
    transition: all 1s;
    &:hover {
      opacity: 0.7;
      path {
        fill: #f95701 !important;
      }
    }
    &.active{
      opacity:1;
      path {
        fill: #f95701 !important;
      }
    }
  }
}
</style>

<script>
import videoGroups from 'components/video/group'
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'index',
  components: {
    'a-video-group': videoGroups,
  },
  computed: {
    ...mapGetters({
      group: 'groups/current',
      ssr: 'general/ssr',
    })
  },
  data(){
    return {
      current:0,
      isFront: true,
    }
  },
  mounted() {
    this.reloadPage(this.$router.currentRoute)
  },
  watch: {
    '$route' (to, from) {
      this.reloadPage(to)
    }
  },
  methods: {
    ...mapActions({
      selectGroup: 'groups/selectCategory',
    }),
    reloadPage(route) {
      this.current = route.params.id

      if(!this.current){
        this.current = route.path.replace(/\//, "")
      }
      
      this.selectGroup({
        id: this.current,
        slug: route.path.replace(/\//, "")
      })
      //this.selectGroup(this.current)
    },
    musculeClick(id){
      if(Number.isInteger(id)){
        this.$router.push({
          name: 'group',
          params: {id}
        })
      } else {
        this.$router.push({
          path: `/${id}`
        })
      }
    }
  }
}
</script>
