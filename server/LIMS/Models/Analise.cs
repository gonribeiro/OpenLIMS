using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace LIMS.Models
{
    public class Analise
    {
        public int Id { get; set; }
        [Required] 
        public string AmostraId { get; set; }
        public Amostra Amostra { get; set; }
        [Required]
        public string SolucaoId { get; set; }
        public Solucao Solucao { get; set; }
        public Boolean Laudo { get; set; } // Positivo ou Negativo
        public string Observacao { get; set; } // Comentários sobre o resultado se houver
        public DateTime Create_at { get; set; }
        public DateTime Delete_at { get; set; }
    }
}
