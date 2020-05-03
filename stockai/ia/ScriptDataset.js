
        var mes = 1;
        var dia = 1;
        var lote = 1;
        let dataseet1 = [], dataseet2 = [], dataseet3 = [], dataseet4 = [], dataseet5 = [], dataseet6 = [], dataseet7 = [], dataseet8 = [], dataseet9 = [];
        let dataseet10 = [], dataseet11 = [], dataseet12 = [], dataseet13 = [], dataseet14 = [], dataseet15 = [], dataseet16 = [], dataseet17 = [], dataseet18 = [], dataseet19 = [];
        let dataseet20 = [], dataseet21 = [], dataseet22 = [], dataseet23 = [], dataseet24 = [], dataseet25 = [], dataseet26 = [], dataseet27 = [], dataseet28 = [];
        let listAllDataseet = [];
        let label = [];
        var date_fab_ref = "2019-12-31";
        var date_val_ref = "2020-01-15";


        /*  listAllDataseet = {
              dataseet1, dataseet2, dataseet3, dataseet3, dataseet5, dataseet6, dataseet7, dataseet8, dataseet9,
              dataseet10, dataseet11, dataseet12, dataseet13, dataseet14, dataseet15, dataseet15, dataseet17, dataseet18, dataseet19,
              dataseet20, dataseet21, dataseet22, dataseet23, dataseet24, dataseet25, dataseet26, dataseet27, dataseet28
  
          }*/


        listAllDataseet.push({
            name: "Arroz Tio Urbano 1 Kg",
            price: 2.89,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({
            name: "Feijão Carioca KiCaldo 1kg",
            price: 5.99,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-31",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-31") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({
            name: "Massa Macarrão Imp 500g",
            price: 1.49,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2020-01-05",
            lote: lote,
            date_val: "2020-01-30",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-30") - new Date("2020-01-05")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({
            name: "Refri coca cola 2l",
            price: 5.99,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-10",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-10") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });

        listAllDataseet.push({
            name: "Biscoito Cream Cracker 400g",
            price: 2.48,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-10",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-10") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });

        listAllDataseet.push({
            name: "Biscoito Passa Tempo 130g",
            price: 0.99,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });

        listAllDataseet.push({
            name: "Skol Lata",
            price: 1.69,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2020-01-01",
            lote: lote,
            date_val: "2020-01-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-15") - new Date("2020-01-01")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Creme Dental Sorriso",
            price: 1.19,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Ruffles 57g",
            price: 3.19,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-10",
            lote: lote,
            date_val: "2020-01-20",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-20") - new Date("2019-12-10")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Manteiga Deline 250g",
            price: 1.89,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-30",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-30") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({
            name: "Cigarro HOLLYWOOD",
            price: 7.75,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-02-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-02-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "BISTECA SUINA CONG",
            price: 11.39,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });

        listAllDataseet.push({
            name: "Sobrecoxa Sadia 1kg",
            price: 8.54,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-02-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-02-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Filé de Peito Perdigão 1kg",
            price: 10.79,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-02-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-02-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Coxa Sadia 1kg",
            price: 7.79,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-02-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-02-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Redbull 250ml",
            price: 4.97,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Alcool gel 500ml",
            price: 13.99,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-15",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-15") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Cheetos 50g",
            price: 2.22,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-10",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-10") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Massa de Lasanha 500g",
            price: 2.99,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-30",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-30") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Danone 170g",
            price: 1.79,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-07",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-07") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });

        listAllDataseet.push({

            name: "Oleo Soya 900l",
            price: 3.69,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-10",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-10") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Flocão Dona Clara 500g",
            price: 1.99,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-07",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-07") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });

        listAllDataseet.push({
            name: "Biscouto Maizena 500g",
            price: 2.98,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-19",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-19") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Pipoca Yoki",
            price: 1.57,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-17",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-17") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Nescau 400g",
            price: 3.99,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-30",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-30") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "Leite Ninho 400g",
            price: 9.89,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-30",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-30") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });
        listAllDataseet.push({

            name: "File de Peixe",
            price: 18.7,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-10",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-10") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });

        listAllDataseet.push({
            name: "Camarão 500g",
            price: 27.9,
            sale: 0,
            stock: 50,
            date: "2020-01-01",
            date_fab: "2019-12-31",
            lote: lote,
            date_val: "2020-01-20",
            qtd_day: Math.ceil(Math.abs(new Date("2020-01-20") - new Date("2019-12-31")) / (1000 * 60 * 60 * 24))


        });


        label.push({
            new_stock: 0,
            stock_date_expiration: 0,
            sell_loss: 0

        });
        console.log("asda");
        // console.log(listAllDataseet);

        //console.log(listAllDataseet);

        /*  Object.keys(listAllDataseet).forEach(key => {
              console.log(key + ' - ' + listAllDataseet[key]) // key - value
          })*/

        /*Object.entries(listAllDataseet).forEach(([key, value]) => {
            console.log(key + ' - ' + value[0].stock) // key - value
        })*/
        var dataseet = [];
        var Auxdata = [];
        var yy = 0;
        //var o = null;
        for (var y = 0; y < 28; y++) {
            //$.extend( true, Auxdata, dataseet );

            // Object.assign(Auxdata, dataseet);
            // Auxdata.push(dataseet);
            var dataseet = null;
            var dataseet = [];
            var mes = 1;
            var dia = 1;
            var lote = 1;






            yy++;
            /* if(y==0) dataseet.push( listAllDataseet.dataseet1[0]);
             if(y==1) dataseet.push( listAllDataseet.dataseet2[0]);
             if(y==2) dataseet.push( listAllDataseet.dataseet3[0]);
             if(y==3) dataseet.push( listAllDataseet.dataseet4[0]);
             if(y==4) dataseet.push( listAllDataseet.dataseet5[0]);
             if(y==5) dataseet.push( listAllDataseet.dataseet6[0]);
             if(y==6) dataseet.push( listAllDataseet.dataseet7[0]);
             if(y==7) dataseet.push( listAllDataseet.dataseet8[0]);
             if(y==8) dataseet.push( listAllDataseet.dataseet9[0]);
             if(y==9) dataseet.push( listAllDataseet.dataseet10[0]);
             if(y==10) dataseet.push( listAllDataseet.dataseet11[0]);
             if(y==11) dataseet.push( listAllDataseet.dataseet12[0]);*/
            dataseet.push(listAllDataseet[y]);
            date_fab_ref = dataseet[0].date_fab;
            date_val_ref = dataseet[0].date_val;
            // dataseet.push( listAllDataseet.dataseet1[0]);
            //dataseet.push(listAllDataseet.dataseet1[0]);


            //  console.log(" nn");


            //console(dataseet[0]+"..");
            for (var i = 0; i < 62; i++) {

                var range = Math.floor(Math.random() * 20);
                // console.log(dataseet[i].stock + "Naruto");
                // console.log(i+' 1 '+dataseet.length);
                var stockAtual = dataseet[i].stock;
                var saleAtual = range;
                var stockAtualizado = parseInt(dataseet[i].stock) - parseInt(range);
                var validade = dataseet[i].qtd_day;
                console.log(dataseet[i].name + " Range " + range + " Estoque Atual " + stockAtual + " stockAtualizado " + stockAtualizado + " numero data " + dataseet.length + " validade " + validade);


                dia++;


                if (stockAtual < range || validade <= 5) {
                    lote++;

                    if (validade <= 5) {
                        label.push({
                            new_stock: 1,
                            stock_date_expiration: 1,
                            sell_loss: range - stockAtual


                        });

                        validade = dataseet[i].qtd_day;
                        dataseet[i].lote = dataseet[i].lote++;
                        stockAtual = 0;
                    } else {
                        label.push({
                            new_stock: 1,
                            stock_date_expiration: 0,
                            sell_loss: range - stockAtual


                        });
                    }
                    var atualiza = 50;
                    date_fab_ref = formatDate(new Date(date_fab_ref));
                    date_val_ref = formatDate(new Date(date_val_ref));
                    if (dia >= 10) {
                        dataseet.push({
                            name: dataseet[i].name,
                            price: dataseet[i].price,
                            sale: stockAtual,
                            stock: atualiza,
                            date: `2020-0${mes}-${dia}`,
                            date_fab: date_fab_ref,
                            lote: lote,
                            date_val: date_val_ref,
                            qtd_day: validade

                        });
                    }
                    if (dia < 10) {
                        dataseet.push({
                            name: dataseet[i].name,
                            price: dataseet[i].price,
                            sale: stockAtual,
                            stock: atualiza,
                            date: `2020-0${mes}-0${dia}`,
                            date_fab: date_fab_ref,
                            lote: lote,
                            date_val: date_val_ref,
                            qtd_day: validade

                        });
                    }


                    if (dia == 29) {
                        dia = 0;
                        mes++;
                    } validade--;
                    // console.log(123);
                }
                if (stockAtual != 0 && stockAtual > range) {

                    label.push({
                        new_stock: 0,
                        stock_date_expiration: 0,
                        sell_loss: 0


                    });
                    var atualiza = stockAtual - range;

                    if (dia >= 10) {
                        dataseet.push({
                            name: dataseet[i].name,
                            price: dataseet[i].price,
                            sale: range,
                            stock: atualiza,
                            date: `2020-0${mes}-${dia}`,
                            date_fab: date_fab_ref,
                            lote: lote,
                            date_val: date_val_ref,
                            qtd_day: validade
                        });


                    } if (dia < 10) {
                        dataseet.push({
                            name: dataseet[i].name,
                            price: dataseet[i].price,
                            sale: range,
                            stock: atualiza,
                            date: `2020-0${mes}-0${dia}`,
                            date_fab: date_fab_ref,
                            lote: lote,
                            date_val: date_val_ref,
                            qtd_day: validade
                        });


                    }




                    if (dia == 29) {
                        dia = 0;
                        mes++;
                    }
                    validade--;
                    // console.log(12);
                }


                if (stockAtualizado == 0) {
                    lote++;
                    validade = 15;

                    label.push({
                        new_stock: 1,
                        stock_date_expiration: 0,
                        sell_loss: 0

                    });
                    if (dia >= 10) {
                        dataseet.push({
                            name: dataseet[i].name,
                            price: dataseet[i].price,
                            sale: 0,
                            stock: 50,
                            date: `2020-0${mes}-${dia}`,
                            date_fab: date_fab_ref,
                            lote: lote,
                            date_val: date_val_ref,
                            qtd_day: validade

                        });
                    }
                    if (dia < 10) {
                        dataseet.push({
                            name: dataseet[i].name,
                            price: dataseet[i].price,
                            sale: 0,
                            stock: 50,
                            date: `2020-0${mes}-0${dia}`,
                            date_fab: date_fab_ref,
                            lote: lote,
                            date_val: date_val_ref,
                            qtd_day: validade

                        });
                    }


                    if (dia == 29) {
                        dia = 0;
                        mes++;
                    } validade--;
                    //console.log(1234);


                }
                Auxdata.push(dataseet[i]);
                //console.log("Verification")
                // console.log(dataseet[i].date_fab)
            }
        }



        function formatDate(data) {

            const newDate = addDays(data, dataseet[i].qtd_day)


            return (newDate.toLocaleDateString('pt-BR', { timeZone: 'UTC' }));
        }

        function addDays(date, days) {
            const copy = new Date(Number(date))
            copy.setDate(date.getDate() + days)
            return copy
        }
        /*function time(x) {
            var myDate = x;
            myDate = myDate.split("-");
            var newDate = myDate[1] + "/" + myDate[0] + "/" + myDate[2];
            return new Date(newDate).getTime();
        }*/

        var fs = require('fs');
        const devtoListTrimmed = Auxdata.filter(n => n != undefined)
        fs.writeFile("testeCrispa.json",
            JSON.stringify(devtoListTrimmed, null, 4),
            (err) => console.log('File successfully written!'))


        const devtoListTrimmed1 = label.filter(n => n != undefined)
        fs.writeFile("labelTesteCrispa.json",
            JSON.stringify(devtoListTrimmed1, null, 4),
            (err) => console.log('File successfully written!'))
