<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Params and Args</title>
    <script>
        function sayHello(firstName, lastName, gender, phoneNumber, email){
            alert("Hello " + firstName + " " + lastName);
        }

        function sayHello2(objParam){
            var firstName = objParam.firstName || "";
            var lastName = objParam.lastName || "";
            alert("Hello " + firstName + " " + lastName);
        }

        sayHello2({
            firstName: "Bob",
            lastName: "Jones"
        });
    </script>
</head>
<body>
    <?php

    function sayHello($args){
        $firstName = $args["firstName"] ?? "";
        $lastName = $args["lastName"] ?? "";

        echo("Hello $firstName $lastName");
    }

    sayHello(array(
        "firstName" => "Bob",
        "lastName" => "Smith"
    ));

    ?>
</body>
</html>