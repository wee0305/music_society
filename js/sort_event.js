/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


//   Web System
//    
//   Music Society
//   Author:Leong Kuan Fei
//   Date: 31/8/2022
//   
//   Filename: sort_event.js

function sortTable(n) {
    var table, rows, switching, z, xtd, ytd, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("eventListing");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
     no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByClassName("data");
        /* Loop through all table rows (except the
         first, which contains table headers): */
        for (z = 0; z < rows.length - 1; z++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
             one from current row and one from the next: */
            xtd = rows[z].getElementsByTagName("td")[n];
            ytd = rows[z + 1].getElementsByTagName("td")[n];
            /* Check if the two rows should switch place,
             based on the direction, asc or desc: */
            if (dir === "asc") {
                if (n === 0) {
                    if (Number(xtd.innerHTML) > Number(ytd.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    if (xtd.innerHTML.toLowerCase() > ytd.innerHTML.toLowerCase()) {
                        console.log(xtd.innerHTML.toLowerCase);
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;

                    }
                }
            } else if (dir === "desc") {
                if (n === 0) {
                    if (Number(xtd.innerHTML) < Number(ytd.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    if (xtd.innerHTML.toLowerCase() < ytd.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
             and mark that a switch has been done: */
            rows[z].parentNode.insertBefore(rows[z + 1], rows[z]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /* If no switching has been done AND the direction is "asc",
             set the direction to "desc" and run the while loop again. */
            if (switchcount === 0 && dir === "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}