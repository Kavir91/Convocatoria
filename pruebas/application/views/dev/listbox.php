<html>
    <head>
        <script src= "<?php echo base_url() ?>/javascript/jquery-1.11.1.min.js"></script>
        <title>pruebas</title>
    </head>
    <style>
        div.sample > * {
            float: left;
        }

        .standardWrapper {
            overflow-x: hidden;
            overflow-y: auto;
            border: solid thin black;
            position: relative;
            padding: 0 10px;
            margin: 0 10px;
        }

        #standardLB {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        #standardLB > li {
            padding: 3px;
        }

        #standardLB > li > a {
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
            font: bold 15px/15px HelveticaNeue, Arial;
            padding: 3px 5px;
            border: 1px solid #dedede;
            background: #a5b8c6;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#becbd6', endColorstr='#88a1b4'); /* IE */
            background: -webkit-gradient(linear, left top, left bottom, from(#becbd6), to(#88a1b4)); /* WebKit */
            background: -moz-linear-gradient(top, #becbd6, #88a1b4);
            border-color: #a2afb8 #8696a1 #6f818f;
            color: #000;
            text-shadow: 0 1px 0 #c4d0d9;
            -webkit-box-shadow: 0 1px 1px #d3d3d3, inset 0 1px 0 #ced8e0;
            -moz-box-shadow: 0 1px 1px #d3d3d3, inset 0 1px 0 #ced8e0;
            box-shadow: 0 1px 1px #d3d3d3, inset 0 1px 0 #ced8e0;  
        }

        #standardLB > li > a.selected {
            background: #adbfcb;
            border-color: #8996a0 #798791 #6c7a85;
            text-shadow: 0 1px 0 #ced9e0;
            -webkit-box-shadow: 0 1px 1px #d3d3d3, inset 0 1px 0 #c2cfd8;
            -moz-box-shadow: 0 1px 1px #d3d3d3, inset 0 1px 0 #c2cfd8;
            box-shadow: 0 1px 1px #d3d3d3, inset 0 1px 0 #c2cfd8;  
        }

        #standardLB > li > a > span {
            display: block;
            width: 80px;
            text-align: left;
        }

        #standardSelect {
            margin-left: 50px;
        }

        .desc {
            clear: both;
        }
    </style>
    <body>
        <script>
            $A.bind(window, 'load', function () {

                // Set the Standard ARIA Listbox

                var standardListbox = new $A.Listbox($A.getEl('standardLB'),
                        {
                            defaultIndex: 2,
                            label: 'Pick a number',
                            callback: function (optionNode, optionsArray) {
                                // Toggle the class "selected"
                                $A.query(optionsArray, function (i, o) {
                                    if (o == optionNode)
                                        $A.addClass(o, 'selected');

                                    else
                                        $A.remClass(o, 'selected');
                                });
                                // Set the Standard Select Field to match this.val()
                                $A.getEl('standardSelect').value = this.val();
                            }
                        });

                // Bind the standard Select field with the Standard ARIA Listbox

                $A.bind('#standardSelect', 'change blur', function (ev) {
                    // Set the Standard ARIA Listbox to match this.value
                    standardListbox.val(this.value);
                });
            });
        </script>
        <p>
            ejemplo de listbox
        </p>

        <ul role="listbox" id="standardLB" >
            <li>
                <a href="#" role="option" id="standardOpt1" >
                    <span class="lbl">One</span>
                </a>
            </li>
            <li>
                <a href="#" role="option" id="standardOpt2" >
                    <span class="lbl">Two</span>
                </a>
            </li>
            <li>
                <a href="#" role="option" id="standardOpt3" >
                    <span class="lbl">Three</span>
                </a>
            </li>
            <li>
                <a href="#" role="option" id="standardOpt4" >
                    <span class="lbl">Four</span>
                </a>
            </li>
            <li>
                <a href="#" role="option" id="standardOpt5" >
                    <span class="lbl">Five</span>
                </a>
            </li>
        </ul>

    </body>
</html>