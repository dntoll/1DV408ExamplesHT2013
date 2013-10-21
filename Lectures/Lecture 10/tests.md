# Testcases #

## Testcase 1.1 Navigate to page ##
1. Open new browser
1. Navigate to page
1. System shows empty cart and list of products with buy-buttons and price


## Testcase 1.2 Buy Product ##
1. Testcase 1.1 Navigate to page
1. Click on buy for product 1
1. Product one is in cart and feedback

## Testcase 1.3 Buy two Products ##
1. Testcase 1.2 Navigate to page
1. Click on buy for product 1
1. Two Products is in cart and feedback



## Testcase 1.4 Buy non existing Product ##
1. Testcase 1.1 Navigate to page
1. Write product in url
1. show error feedback

## Testcase 1.5 Dont buy on Reload
1. Testcase 1.2 Buy product
1. Reload page with F5
1. Only one product in Cart

## Testcase 1.6 Remove non existing Product from Cart##
1. Testcase 1.1 Navigate to page
1. Write remove product in url
1. show error feedback

## Testcase 1.7 Remove  product from Cart##
1. Testcase 1.2 Buy Product
1. Click on remove button
1. show empty cart and feedback

## Testcase 2.1 Create order
1. Testcase 1.3 Buy two products
1. Go to checkout
1. Cart and sum is displayed and system asks for an adress
1. Enters valid adress
1. System provides feedback that an order can be created and ask customer to confirm.
1. confirm order
1. System displays receipt with cart and sum

## Testcase 2.1.1 missing adress 
1. Testcase 1.3 Buy two products
1. Go to checkout
1. Cart and sum is displayed and system asks for an adress
1. Confirm order