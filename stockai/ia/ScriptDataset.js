var mes = 1;
var dia = 1;
var lote = 1;
let dataseet = [];
let label = [];
var date_fab_ref = "2019-12-31";
var date_val_ref = "2020-01-15";

dataseet.push({
    name: "Arroz Tio Urbano 1 Kg",
    price: 2.89,
    sale: 0,
    stock: 50,
    date: "2020-01-01",
    date_fab: "2019-12-31",
    lote: lote,
    date_val: "2020-01-15",
    qtd_day: Math.ceil(Math.abs(new Date("2020-01-15") - new Date("2019-12-31"))/(1000*60*60*24))


});

label.push({
    new_stock: 0,
    stock_date_expiration: 0
});

console.log(dataseet[0].stock);

for (var i = 0; i < 60; i++) {
    var range = Math.floor(Math.random() * 20);
    var stockAtual = dataseet[i].stock;
    var saleAtual = range;
    var stockAtualizado = parseInt(dataseet[i].stock) - parseInt(range);
    var validade = dataseet[i].qtd_day;
    //console.log("Range " + range + " Estoque Atual" + stockAtual + " stockAtualizado" + stockAtualizado);


    dia++;


    if (stockAtual < range || validade <= 5) {
        lote++;

        if (validade <= 5) {
            label.push({
                new_stock: 1,
                stock_date_expiration: 1,
                sell_loss: sales-range


            });

            validade = dataseet[i].qtd_day;
            dataseet[i].lote =dataseet[i].lote++; 
        } else {
            label.push({
                new_stock: 1,
                stock_date_expiration: 0

            });
        }
        var atualiza = 50;
        date_fab_ref = formatDate(new Date(date_fab_ref));
        date_val_ref = formatDate(new Date(date_val_ref));
        if (dia >= 10) {
            dataseet.push({
                name: "Arroz Tio Urbano 1 Kg",
                price: 2.89,
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
                name: "Arroz Tio Urbano 1 Kg",
                price: 2.89,
                sale: stockAtual,
                stock: atualiza,
                date: `2020-0${mes}-0${dia}`,
                date_fab:  date_fab_ref,
                lote: lote,
                date_val: date_val_ref,
                qtd_day: validade

            });
        }


        if (dia == 30) {
            dia = 0;
            mes++;
        } validade--;
        console.log(123);
    }
    if (stockAtual != 0 && stockAtual > range) {

        label.push({
            new_stock: 0,
            stock_date_expiration: 0

        });
        var atualiza = stockAtual-range;

        if (dia >= 10) {
            dataseet.push({
                name: "Arroz Tio Urbano 1 Kg",
                price: 2.89,
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
                name: "Arroz Tio Urbano 1 Kg",
                price: 2.89,
                sale: range,
                stock: atualiza,
                date: `2020-0${mes}-0${dia}`,
                date_fab: date_fab_ref,
                lote: lote,
                date_val: date_val_ref,
                qtd_day: validade
            });


        }

       


        if (dia == 30) {
            dia = 0;
            mes++;
        }
        validade--;
        console.log(12);
    }
    
    
    if (stockAtual == 0) {
        lote++;
        validade = 15;

        label.push({
            newstock: 1,
            stock_date_expiration: 0

        });
        if (dia >= 10) {
            dataseet.push({
                name: "Arroz Tio Urbano 1 Kg",
                price: 2.89,
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
                name: "Arroz Tio Urbano 1 Kg",
                price: 2.89,
                sale: 0,
                stock: 50,
                date: `2020-0${mes}-0${dia}`,
                date_fab: date_fab_ref,
                lote: lote,
                date_val: date_val_ref,
                qtd_day: validade

            });
        }


        if (dia == 30) {
            dia = 0;
            mes++;
        } validade--;
        console.log(1234);


    }
    
    console.log("Verification")
    console.log(dataseet[i].date_fab)
    
}

function formatDate(data) {

    const newDate= addDays(data,dataseet[i].qtd_day)
        
    dia  = newDate.getDate().toString().padStart(2, '0'),
    mes  = (newDate.getMonth()+1).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro começa com zero.
    ano  = newDate.getFullYear();

    return (newDate.toLocaleDateString('pt-BR', {timeZone: 'UTC'}));   
}

function addDays(date, days) {
    const copy = new Date(Number(date))
    copy.setDate(date.getDate() + days)
    return copy
  }
  
  

var fs = require('fs');

const devtoListTrimmed = dataseet.filter(n => n != undefined)
fs.writeFile('testeCrispa.json',
    JSON.stringify(devtoListTrimmed, null, 4),
    (err) => console.log('File successfully written!'))


const devtoListTrimmed1 = label.filter(n => n != undefined)
fs.writeFile('labelTesteCrispa.json',
    JSON.stringify(devtoListTrimmed1, null, 4),
    (err) => console.log('File successfully written!'))