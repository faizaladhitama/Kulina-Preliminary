import java.util.ArrayList;
import java.util.Arrays;
import java.util.Scanner;

public class Prima {
	public static void main(String[] args) {
		Scanner in = new Scanner(System.in);
		
		System.out.println("Masukkan input angka :");
		int num = in.nextInt();
		System.out.println("Menampilkan bilangan prima sampai dengan bilangan input :");
		System.out.println(Arrays.toString(showPrime(num)));
	}
	
	public static Object[] showPrime(int num) {
		ArrayList<Integer> result = new ArrayList<Integer>();
		if(num == 2) {
			result.add(num);
		}else {
			int k = 0;
			result.add(2);
			for(int i = 3; i <= num; i++) {
				for(int j = 2; j <= i; j++) {
					if(i%j == 0) {
						k++;
					}	
				}
				if(k == 1) {
					result.add(i);
				}
				k = 0;
			}
		}
		return result.toArray();
	}
}
